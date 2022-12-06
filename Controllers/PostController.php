<?php
namespace App\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function showPost ()
    {
        $id = $_GET["post_id"];

        if (empty($id))
        {
            header('HTTP/1.0 404 Not Found');
            $this->render("Views/404");
            return;
        }

        $post = new Post();
        $post = $post->getPost($id);

        if (empty($post))
        {
            header('HTTP/1.0 404 Not Found');
            $this->render("Views/404");
        }
        else
        {
            $post = $post[0];
            $this->render("Views/single", compact("post"));
        }
    }

    public function showAllPosts ()
    {

    }
}