<?php
namespace App\Controllers;

abstract class Controller
{
    protected function render ($view, $data = []): void
    {
        extract($data);
        require $view . ".php";
    }
}