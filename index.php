<?php
// Namespace global de l'application. C'est à partir de lui que l'on ira chercher toutes les classes dans leurs namespaces respectifs.
// Les namespaces sont arbitraires et peuvent être nommés de la manière que l'on souhaite.
// Attention : dans un projet avec Composer, il faut bien spécifier dans le composer.json comment se nomme le namespace racine du projet et son emplacement dans l'encart autoload > psr-4
namespace App;

// Appel de l'autoloader de Composer qui charge nos classes dynamiquement
require "vendor/autoload.php";

// Les use des classes que l'on utilise dans cette page. Les use fonctionnent de pairs avec les namespaces.
use App\Controllers\AdminController;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\PostController;
use App\Models\Database;
use Dotenv\Dotenv;

// Initialisation du module externe DotEnv pour cacher les données sensibles (identifiants de connexion à la BDD par exemple
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Les constantes du fichier .env pour la connexion à la base de données sont maintenant stockées dans les superglobales $_SERVER et $_ENV
Database::$host = $_ENV["DB_HOST"];
Database::$user = $_ENV["DB_USER"];
Database::$pass = $_ENV["DB_PASSWORD"];
Database::$dbName = $_ENV["DB_NAME"];

// Appel la méthode statique de connexion à la base de données
Database::connect();

// Router
// Gestion du routage vers l'affichage des articles (vue : single). Route : /?post_id={id}
if (isset($_GET["post_id"]) && !isset($_GET["action"]))
{
    // On instancie le controller en rapport
    $controller = new PostController();

    /**
     * Si le paramètre GET est vide on affiche la 404.
     */
    if (empty($_GET["post_id"]))
    {
        echo $controller->showErrorPage();
    }
    /**
     * Sinon on demande au controller d'afficher le post.
     * Ensuite le controller demande les données au model.
     * Le model va chercher les données dans la BDD puis les renvoie au controller qui peut les traiter.
     * Enfin le controller renvoie les données traitées à la vue.
     * Tip : ne pas hésiter à faire ctrl+clic sur les fonctions pour remonter dans les fichiers.
     */
    else
    {
        echo $controller->showPost($_GET["post_id"]);
    }
}
// Gestion du routage vers les articles d'une catégorie (vue : blog). Route : /?cat_id={id}
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
// Gestion du routage vers le blog (vue : blog). Route : /?action=blog
elseif (isset($_GET["action"]) && $_GET["action"] === "blog")
{
    $controller = new PostController();
    echo $controller->showAllPosts();
}
// Gestion du routage vers la page des catégories (vue : categories). Route : /?action=all_categories
elseif (isset($_GET["action"]) && $_GET["action"] === "all_categories")
{
    $controller = new CategoryController();
    echo $controller->showAllCategories();
}
// Gestion du routage vers l'admin' (vue : admin).
elseif (isset($_GET["action"]) && $_GET["action"] === "admin")
{
    $controller = new AdminController();

    // Gestion de l'administration des articles. Route : /?action=admin&manage=posts
    if (isset($_GET["manage"]) && $_GET["manage"] === "posts")
    {
        echo $controller->showPostsManager();
    }
    // Gestion de l'administration des catégories. Route : /?action=admin&manage=categories
    elseif (isset($_GET["manage"]) && $_GET["manage"] === "categories")
    {
        echo $controller->showCategoriesManager();
    }
    // Gestion de l'administration des utilisateurs. Route : /?action=admin&manage=users
    elseif (isset($_GET["manage"]) && $_GET["manage"] === "users")
    {
        echo $controller->showUsersManager();
    }
    // Gestion de l'accueil de l'administration. Route : /?action=admin
    else
    {
        echo $controller->showAdminPanel();
    }
}
// Gestion de la suppression des articles. Route : /?action=delete&post_id={id}
elseif (isset($_GET["action"]) && $_GET["action"] === "delete")
{
    $controller = new AdminController();

    if (isset($_GET["post_id"]))
    {
        // Lance la suppression et récupère le nombre de lignes supprimées. 1 = success, 0 = fail
        $rowCount = $controller->deletePost($_GET["post_id"]);
        // Sert à l'affichage d'un message d'erreur ou de succès sur la vue twig. fail = erreur lors de la suppression, success = suppression ok, none = rien (pour l'affichage de la page d'accueil de l'admin
        $messageDelete = "fail";

        // Si le nombre de lignes supprimées est égal à 1 alors la suppression à bien été effectuée et on passe le message à success
        if ($rowCount == 1)
        {
            $messageDelete = "success";
        }

        // Appel du controller Admin en passant en paramètre le message fail/success récupéré lors de la suppression en BDD
        echo $controller->showPostsManager($messageDelete);
    }
}
// Gestion du routage vers la page d'accueil (vue : home). Route : /
elseif ($_SERVER["REQUEST_URI"] == "/")
{
    $controller = new HomeController();
    echo $controller->showHome();
}
