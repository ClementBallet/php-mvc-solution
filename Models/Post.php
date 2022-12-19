<?php

namespace App\Models;

/**
 * Model chargé d'être en relation avec les articles en base de données
 */
class Post
{
    /**
     * Renvoie l'article associé à l'id passé en paramètre avec toutes ses infos (titre, contenu, date...).
     * On récupère également le nom de la catégorie associée à l'article (qui n'est pas présent dans la table post).
     * @param int $post_id L'id de l'article
     * @return bool|array
     */
    public function getPost(int $post_id): bool|array
    {
        $params = [
            "post_id" => $post_id
        ];
        Database::connect();
        Database::prepReq(
            "SELECT *, category.name AS category_name
            FROM post 
            INNER JOIN category
            ON post.category_id = category.id
            WHERE post.id = :post_id",
            $params
        );
        return Database::fetchData();
    }

    /**
     * Retourne tous les articles présents en BDD
     * TODO : peut être optimisé en renvoyant seulement une quantité d'article souhaité. Exemple : 10.
     * @return bool|array
     */
    public function getAllPosts(): bool|array
    {
        Database::connect();
        Database::prepReq(
            "SELECT post.*, category.name AS category_name
            FROM post 
            INNER JOIN category
            ON post.category_id = category.id"
        );
        return Database::fetchData();
    }

    /**
     * Retourne tous les articles associés à une catégorie passée en paramètre.
     * @param int $cat_id L'id de la catégorie associée
     * @return bool|array
     */
    public function getAllPostsFromCategory(int $cat_id): bool|array
    {
        $params = [
            "cat_id" => $cat_id
        ];
        Database::connect();
        Database::prepReq(
            "SELECT *, category.name AS category_name
                FROM post 
                INNER JOIN category
                ON post.category_id = category.id
                WHERE post.category_id = :cat_id",
            $params
        );

        return Database::fetchData();
    }

    /**
     * Supprime un article via son id passé en paramètre et retourne un entier qui représente le nombre de ligne affectée par la suppression.
     * @param int $post_id L'id de l'article à supprimer
     * @return int 1 = success, 0 = fail
     */
    public function deletePost(int $post_id): int
    {
        $params = [
            "post_id" => $post_id
        ];
        Database::connect();
        return Database::prepReq(
            "DELETE FROM post WHERE post.id = :post_id",
            $params
        );
    }
}