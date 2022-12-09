<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function showHome(): string
    {
        return $this->render("home.twig");
    }
}
