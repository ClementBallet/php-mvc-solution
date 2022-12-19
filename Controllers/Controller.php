<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\DebugExtension;
use Twig\Extra\Intl\IntlExtension;
use Twig\Extra\String\StringExtension;
use Twig\Loader\FilesystemLoader;

/**
 * Classe Controller principale.
 * Elle est abstraite et ne peut donc pas être instanciée directement et devra être héritée par les controllers enfants.
 */
abstract class Controller
{
    /**
     * @var Environment|null Variable de type Twig\Environment et qui sert à se resservir l'instanciation de twig plusieurs fois.
     * Le ? devant le type sert à dire que cette variable peut être de type NULL au départ.
     */
    private ?Environment $twig = NULL;

    /**
     * Méthode où l'on instancie Twig avec toutes ses options pour son fonctionnement.
     * Le loader sert à spécifier l'emplacement des vues que Twig va aller chercher.
     * La variable $twig sert à utiliser des méthodes telles que addExtension() pour ajouter des extensions Twig mais aussi render(), indispensable pour afficher nos vues.
     * @return void Cette fonction ne retourne rien.
     */
    private function loadTwig(): void
    {
        /**
         * dirname() sert à récupérer le chemin du dossier parent du dossier/fichier spécifié en paramètre
         * https://www.php.net/manual/fr/function.dirname.php
         * __DIR__ sert à récupérer le chemin vers le fichier courant
         * https://www.php.net/manual/fr/language.constants.magic.php
         */
        $loader = new FilesystemLoader(dirname(__DIR__) . '/Views');
        $this->twig = new Environment($loader, array(
            'debug' => true,
            'cache' => false
        ));
        $this->twig->addExtension(new DebugExtension()); // Ajoute dump() dans Twig (équivalent au var_dump())
        $this->twig->addExtension(new StringExtension()); // Ajoute l'extension pour la manipulation des String
        $this->twig->addExtension(new IntlExtension()); // Ajoute l'extension pour l'internationalisation et manipulation de dates
    }

    /**
     * Déclenche le render de Twig en plusieurs étapes :
     * - le try sert à "essayer" de charger Twig puis de faire le render
     * - si il n'y arrive pas, les blocs catch sont là pour fournir une erreur qui peut nous aiguiller
     * - dans le bloc try, le bloc if sert à vérifier si Twig à déjà été instancié, si oui il ne sera pas ré-instancié
     * @param string $view Le fichier correspondant à la vue. Exemple : blog.twig
     * @param array $data Les données passées à la vue et que Twig pourra afficher. Elles sont vides par défaut.
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function render(string $view, array $data = []): string
    {
        try
        {
            if (is_null($this->twig))
            {
                $this->loadTwig();
            }

            return $this->twig->render($view, $data);
        }
        catch (SyntaxError $e)
        {
            throw new SyntaxError($e->getMessage());
        }
        catch (RuntimeError $e)
        {
            throw new RuntimeError($e->getMessage());
        }
        catch (LoaderError $e)
        {
            throw new LoaderError($e->getMessage());
        }
    }

    /**
     * La méthode qui renvoie la page d'erreur. Elle est dans le controller parent car commune à tous les controllers.
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showErrorPage(): string
    {
        header('HTTP/1.0 404 Not Found'); // Spécifie au navigateur que la page est en erreur 404
        return $this->render("404.twig");
    }
}