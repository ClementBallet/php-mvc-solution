<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class CategoryController extends Controller
{
    public function showAllPostsFromCategory(int $cat_id)
    {
        $posts = new Post();
        $posts = $posts->getAllPostsFromCategory($cat_id);
        $this->render("Views/blog", compact("posts"));
    }

    public function showAllCategories()
    {
        $categories = new Category();
        $categories = $categories->getAllCategories();
        $this->render("Views/categories", compact("categories"));
    }
}