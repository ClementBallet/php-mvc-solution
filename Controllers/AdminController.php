<?php

namespace App\Controllers;

use App\Models\Post;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Controller du panneau d'administration
 * Cette classe est enfant du Controller principal pour en hériter ses méthodes et attributs
 */
class AdminController extends Controller
{
    /**
     * Méthode demandée par la route /?action=admin et affiche le panneau d'administration avec les liens vers la gestion des articles, des catégories et des utilisateurs
     * Envoie les données vers la vue admin.twig
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showAdminPanel(): string
    {
        return $this->render("admin.twig");
    }

    /**
     * Méthode demandée par la route /?action=admin&manage=posts et va demander tous les articles au modèle Post
     * Envoie les données vers la vue admin-posts.twig
     * @param string $messageDelete Gestion du message d'erreur ou de succès pour la suppression des articles
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showPostsManager(string $messageDelete = "none")
    {
        $posts = new Post();
        $posts = $posts->getAllPosts();
        $hostUrl = $_SERVER["HTTP_HOST"]; // Gestion de l'affichage des URLs entières dans l'admin

        return $this->render("admin-posts.twig", compact(
                "posts",
                "hostUrl",
                "messageDelete")
        );
    }

    /**
     * Méthode demandée par la route /?action=delete&post_id={id}
     * Demande au model Post de supprimer l'article par l'id passé en paramètre.
     * @param int $post_id L'id de l'article à supprimer
     * @return int Retourne le nombre de lignes supprimées en BDD. 0 = fail, 1 = success
     */
    public function deletePost(int $post_id): int
    {
        $post = new Post();
        return $post->deletePost($post_id);
    }

    /**
     * TODO
     * Envoie les données vers la vue admin-categories.twig
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showCategoriesManager()
    {
        return $this->render("admin-categories.twig");
    }

    /**
     * TODO
     * Envoie les données vers la vue admin-users.twig
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showUsersManager()
    {
        return $this->render("admin-users.twig");
    }
}