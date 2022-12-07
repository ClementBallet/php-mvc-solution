<?php

namespace App\Controllers;

use App\Models\Category;
use App\Models\Post;

class PostController extends Controller
{
    public function showPost(int $post_id)
    {
        $post = new Post();
        $post = $post->getPost($post_id);

        if (empty($post))
        {
            $this->redirectToErrorPage();
        }
        else
        {
            $post = $post[0];
            $this->render("Views/single", compact("post"));
        }
    }

    public function showAllPosts()
    {
        $posts = new Post();
        $posts = $posts->getAllPosts();

        if (empty($posts))
        {
            $this->redirectToErrorPage();
        }
        else
        {
            $this->render("Views/blog", compact("posts"));
        }
    }
}