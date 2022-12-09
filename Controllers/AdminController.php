<?php

namespace App\Controllers;

class AdminController extends Controller
{
    public function showAdminPanel(): string
    {
        return $this->render("admin.twig");
    }
}