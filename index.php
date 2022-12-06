<?php
namespace App;

spl_autoload_register(function ($class) {
    $class = str_replace(__NAMESPACE__ . '\\', '', $class);
    $class = str_replace('\\', '/', $class);
    require __DIR__ . '/' . $class . '.php';
});
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

Database::$host = "localhost";
Database::$user = "root";
Database::$pass = "";
Database::$dbName = "blog";

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
