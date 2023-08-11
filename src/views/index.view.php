<main class="container">
    <?php if (isset($_SESSION['user'])): ?>
        <h2>All products (<?= $limit ?>)</h2>
        <?php if (!empty($products)): ?>
        <ul>
            <?php foreach ($products as $product): ?>
            <?php extract($product) ?>
            <li><a href="/product?id=<?= $productCode ?>"><?= $productName ?></></li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
        <a class="secondary" href="index?limit=<?= $limit + 20 ?>" role="button">get more</a>
        <?php if ($limit > 20): ?>
        <a class="contrast" href="index?limit=<?= $limit - 20 ?>" role="button">get less</a>
        <?php endif; ?>
    <?php else: ?>
        <h3>Please login or register to see the list of products.</h3>
        <a href="login" role="button" class="secondary">Login</a>
        <a href="register" role="button" class="contrast">Register</a>
        <?php if (isset($_GET['msg']) && $_GET['msg'] == "delete"): ?>
            <p style="color: lightgreen;">Your profile as been successfully deleted.</p>
        <?php endif; ?>
    <?php endif; ?>
</main>