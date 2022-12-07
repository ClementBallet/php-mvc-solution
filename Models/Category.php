<?php

namespace App\Models;

class Category
{
    public function getCategory(int $post_id): bool|array
    {
        $params = [
            "id" => $post_id
        ];
        Database::connect();
        Database::prepReq(
            "SELECT category.name 
            FROM post 
            INNER JOIN category 
            ON post.category_id = category.id 
            WHERE post.id = :id",
            $params
        );
        return Database::fetchData();
    }

    public function getAllCategories(): bool|array
    {
        Database::connect();
        Database::prepReq("SELECT * FROM category");
        return Database::fetchData();
    }
}