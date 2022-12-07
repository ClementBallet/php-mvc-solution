<?php
$categories = $data["categories"];

require "header.php";
?>

<h2>Toutes les catégories</h2>

<section class="all-categories card-container">
    <?php foreach ($categories as $category) : ?>
        <article class="card">
            <a href="/?cat_id=<?= $category["id"] ?>" class="category"><?= $category["name"] ?></a>
        </article>
    <?php endforeach; ?>
</section>