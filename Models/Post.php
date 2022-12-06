<?php
namespace App\Models;

use App\Models\Database;

class Post
{
    public function getPost (int $id): bool|array
    {
        $params = [
            "id" => $id
        ];
        Database::connect();
        Database::prepReq("SELECT * FROM post WHERE id = :id", $params);
        return Database::fetchData();
    }

    public function getAllPost ()
    {
        Database::connect();
        Database::prepReq("SELECT * FROM post");
        return Database::fetchData();
    }
}