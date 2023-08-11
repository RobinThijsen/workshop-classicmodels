<?php extract($productInfo); ?>
<main class="container">
    <h1><?= $productName ?></h1>
    <h3><a href="productLine?productLine=<?= $productLine ?>"><?= $productLine ?></a></h3>
    <p><?= $productDescription ?></p>
    <cite><?= $buyPrice ?> $</cite>
</main>