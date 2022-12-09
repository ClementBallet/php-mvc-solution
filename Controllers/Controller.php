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

abstract class Controller
{
    private ?Environment $twig = null;

    /**
     * @return void
     */
    private function loadTwig(): void
    {
        $loader = new FilesystemLoader(dirname(__DIR__) . '/Views');
        $this->twig = new Environment($loader, array(
            'debug' => true,
            'cache' => false
        ));
        $this->twig->addExtension(new DebugExtension());
        $this->twig->addExtension(new StringExtension());
        $this->twig->addExtension(new IntlExtension());
    }

    /**
     * @param $view
     * @param $data
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    protected function render($view, $data = []): string
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
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showErrorPage()
    {
        try
        {
            header('HTTP/1.0 404 Not Found');
            return $this->twig->render("404.twig");
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
}