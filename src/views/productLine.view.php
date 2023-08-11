<main class="container">
    <?php if ($limit > (int) $productsCount): ?>
    <h2>All products (<?= $productsCount ?>)</h2>
    <?php else: ?>
    <h2>All products (<?= $limit ?>)</h2>
    <?php endif; ?>
    <?php if (!empty($products)): ?>
        <ul>
            <?php foreach ($products as $product): ?>
                <?php extract($product) ?>
                <li><a href="/product?id=<?= $productCode ?>"><?= $productName ?></></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <?php if ((int) $productsCount > 20): ?>
        <?php if ((int) $productsCount > $limit): ?>
            <a class="secondary" href="productLine?productLine=<?= $productLine ?>&limit=<?= $limit + 20 ?>" role="button">get more</a>
        <?php endif; ?>
        <?php if ($limit > 20): ?>
            <a class="contrast" href="productLine?productLine=<?= $productLine ?>&limit=<?= $limit - 20 ?>" role="button">get less</a>
        <?php endif; ?>
    <?php endif; ?>
</main>