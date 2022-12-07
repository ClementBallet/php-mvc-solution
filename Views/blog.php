<?php
$posts = $data["posts"];

$page_title = "";

if (isset($_GET["action"]) && $_GET["action"] === "blog")
{
    $page_title = "Blog";
}
else
{
    $page_title = "Catégorie : " . $posts[0]["category_name"];
}

require "header.php";
?>

<h1><?= $page_title ?></h1>
<h2>Tous les derniers articles</h2>
<section class="card-container">
    <?php foreach ($posts as $post): ?>
        <article class="card">
            <a href="/?post_id=<?= $post["id"] ?>" class="title"><?= $post["title"] ?></a>
            <a href="/?cat_id=<?= $post["category_id"] ?>" class="category"><?= $post["category_name"] ?></a>
            <span>Par <?= $post["author"] ?></span>
            <time>Le <?= $post["created_at"] ?></time>
            <p><?= substr($post["content"], 0, 100) ?>...</p>
        </article>
    <?php endforeach; ?>
</section>

