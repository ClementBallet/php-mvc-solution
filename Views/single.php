<?php
namespace App\Views;

$post = $data["post"];

require "header.php";
?>
<article>
    <h1><?= $post["title"] ?></h1>
    <a href="/?cat_id=<?= $post["category_id"] ?>" class="category"><?= $post["category_name"] ?></a>
    <span>Par <?= $post["author"] ?></span>
    <time>Le <?= $post["created_at"] ?></time>
    <p><?= nl2br($post["content"]) ?></p>
</article>
