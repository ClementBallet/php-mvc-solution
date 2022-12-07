<?php

namespace App\Controllers;

abstract class Controller
{
    protected function render($view, $data = []): void
    {
        extract($data);
        require $view . ".php";
    }

    public function redirectToErrorPage(): void
    {
        header('HTTP/1.0 404 Not Found');
        $this->render("Views/404");
    }
}