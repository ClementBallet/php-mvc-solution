<?php
namespace App;

require "vendor/autoload.php";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mon blog</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

use App\Controllers\PostController;
use App\Models\Database;
use App\Models\Post;
use App\Views\Single;
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
if (isset($_GET["post_id"]))
{
    $controller = new PostController();
    $controller->showPost();
}
elseif (isset($_GET["action"]) && $_GET["action"] === "blog")
{
    $posts = new Post();
    $posts = $posts->getAllPost();

    if (empty($posts))
    {
        header('HTTP/1.0 404 Not Found');
//        render("Views/404");
    }
    else
    {
//        render("Views/blog", compact("posts"));
    }
}
else
{
//    render("Views/home");
}
?>

</body>
</html>
