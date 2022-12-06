<?php
$posts = $data["posts"];
?>
<section class="card-container">
    <?php foreach ($posts as $post): ?>
        <article class="card">
            <a href="/?post_id=<?= $post["id"] ?>"><?= $post["title"] ?></a>
            <span>Par <?= $post["author"] ?></span>
            <time>Le <?= $post["created_at"] ?></time>
            <p><?= substr($post["content"], 0, 100) ?>...</p>
        </article>
    <?php endforeach; ?>
</section>
<a href="/">Retourner à l'accueil du site</a>
