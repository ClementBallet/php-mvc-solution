<?php

namespace App\Models;

use App\Models\Database;

class Post
{
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

    public function getAllPosts(): bool|array
    {
        Database::connect();
        Database::prepReq(
            "SELECT *, category.name AS category_name
            FROM post 
            INNER JOIN category
            ON post.category_id = category.id"
        );

        return Database::fetchData();
    }

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
}