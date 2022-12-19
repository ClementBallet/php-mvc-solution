<?php

namespace App\Controllers;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Controller de la page d'accueil
 * Cette classe est enfant du Controller principal pour en hériter ses méthodes et attributs
 */
class HomeController extends Controller
{
    /**
     * Méthode demandée par la route / (racine de notre URL)
     * Envoie les données vers la vue home.twig
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showHome(): string
    {
        return $this->render("home.twig");
    }
}
