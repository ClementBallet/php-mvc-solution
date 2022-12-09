<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function showPost(int $post_id): string
    {
        $post = new Post();
        $post = $post->getPost($post_id);

        if (empty($post))
        {
            return $this->showErrorPage();
        }
        else
        {
            $post = $post[0];
            return $this->render("single.twig", compact("post"));
        }
    }

    public function showAllPosts(): string
    {
        $posts = new Post();
        $posts = $posts->getAllPosts();

        if (empty($posts))
        {
            return $this->showErrorPage();
        }
        else
        {
            return $this->render("blog.twig", array(
                "posts" => $posts,
                "page_title" => "Blog"
            ));
        }
    }
}