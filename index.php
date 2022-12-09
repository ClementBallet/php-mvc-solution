<?php

namespace App;

require "vendor/autoload.php";

use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Models\Database;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Les constantes du fichier .env pour la connexion à la base de données sont maintenant stockées dans les superglobales $_SERVER et $_ENV
Database::$host = $_ENV["DB_HOST"];
Database::$user = $_ENV["DB_USER"];
Database::$pass = $_ENV["DB_PASSWORD"];
Database::$dbName = $_ENV["DB_NAME"];

Database::connect();

// Router

// Gestion du routage vers l'affichage des articles (vue : single)
if (isset($_GET["post_id"]))
{
    $controller = new PostController();

    if (empty($_GET["post_id"]))
    {
        echo $controller->showErrorPage();
    }
    else
    {
        echo $controller->showPost($_GET["post_id"]);
    }
}
// Gestion du routage vers les articles d'une catégorie (vue : blog)
elseif (isset($_GET["cat_id"]))
{
    $controller = new CategoryController();

    if (empty($_GET["cat_id"]))
    {
        echo $controller->showErrorPage();
    }
    else
    {
        echo $controller->showAllPostsFromCategory($_GET["cat_id"]);
    }
}
// Gestion du routage vers le blog (vue : blog)
elseif (isset($_GET["action"]) && $_GET["action"] === "blog")
{
    $controller = new PostController();
    echo $controller->showAllPosts();
}
// Gestion du routage vers la page des catégories (vue : categories)
elseif (isset($_GET["action"]) && $_GET["action"] === "all_categories")
{
    $controller = new CategoryController();
    echo $controller->showAllCategories();
}
// Gestion du routage vers l'admin' (vue : admin)
elseif (isset($_GET["action"]) && $_GET["action"] === "admin")
{
    $controller = new AdminController();
    echo $controller->showAdminPanel();
}
// Gestion du routage vers la page d'accueil (vue : home)
else
{
    $controller = new HomeController();
    echo $controller->showHome();
}
