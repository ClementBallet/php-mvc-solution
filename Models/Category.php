<?php

namespace App\Models;

/**
 * Model chargé d'être en relation avec les catégories en base de données
 */
class Category
{
    /**
     * Renvoie le nom de la catégorie associée à l'id passé en paramètre
     * @param int $cat_id L'id de la catégorie
     * @return bool|array
     */
    public function getName(int $cat_id): bool|array
    {
        $params = [
            "id" => $cat_id
        ];
        Database::connect();
        Database::prepReq(
            "SELECT category.name 
            FROM category 
            WHERE category.id = :id",
            $params
        );
        return Database::fetchData();
    }

    /**
     * Retourne toutes les catégories
     * @return bool|array
     */
    public function getAllCategories(): bool|array
    {
        Database::connect();
        Database::prepReq("SELECT * FROM category");
        return Database::fetchData();
    }
}