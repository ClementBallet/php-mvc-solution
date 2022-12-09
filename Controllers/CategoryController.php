<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function showAllPostsFromCategory(int $cat_id): string
    {
        $posts = new Post();
        $posts = $posts->getAllPostsFromCategory($cat_id);
        return $this->render("blog.twig", array(
            "posts" => $posts,
            "page_title" => "Categories : "
        ));
    }

    public function showAllCategories(): string
    {
        $categories = new Category();
        $categories = $categories->getAllCategories();
        return $this->render("categories.twig", compact("categories"));
    }
}