<main class="container">
    <ul>
        <?php if (!empty($products)):
        foreach ($products as $product): extract($product); ?>
            <li><a href="/product?id=<?= $productCode ?>"><?= $productName ?></a></li>
        <?php endforeach;
        else: ?>
            <li>No product found</li>
        <?php endif; ?>
    </ul>
</main>