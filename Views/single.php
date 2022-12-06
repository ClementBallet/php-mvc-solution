<?php
namespace App\Views;

$post = $data["post"];
?>

<a href="/">Retour à l'accueil</a>
<a href="/?action=blog">Retour au blog</a>
<article>
    <h1><?= $post["title"]?></h1>
    <span>Par <?= $post["author"] ?></span>
    <time>Le <?= $post["created_at"] ?></time>
    <p><?= nl2br($post["content"]) ?></p>
</article>
