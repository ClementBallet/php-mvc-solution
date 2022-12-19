<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * Controller des catégories d'articles
 * Cette classe est enfant du Controller principal pour en hériter ses méthodes et attributs
 */
class CategoryController extends Controller
{
    /**
     * Méthode demandée par la route /?cat_id={id}
     * Demande au model Post tous les articles associés à une catégorie passée en paramètre.
     * Envoie les données vers la vue blog.twig
     * @param int $cat_id L'id de la catégorie
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showAllPostsFromCategory(int $cat_id): string
    {
        $posts = new Post();
        $posts = $posts->getAllPostsFromCategory($cat_id); // Retrouve tous les articles

        $category = new Category();
        $category_name = $category->getName($cat_id); // Retrouve le nom de la catégorie associée
        $category_name = $category_name[0]["name"];
        $page_title = "Categorie : $category_name"; // Construit le titre de page (nécessaire car le template est le même que pour le blog, mais le titre doit être différent si l'on est sur le blog ou une catégorie)

        return $this->render("blog.twig", compact("posts", "page_title"));
    }

    /**
     * Méthode demandée par la route /?action=all_categories
     * Demande au model Post de supprimer l'article par l'id passé en paramètre.
     * Envoie les données vers la vue categories.twig
     * @return string
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function showAllCategories(): string
    {
        $categories = new Category();
        $categories = $categories->getAllCategories();
        return $this->render("categories.twig", compact("categories"));
    }
}