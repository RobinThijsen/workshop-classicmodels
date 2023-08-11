<main class="container">
    <form action="#" method="post">
        <label for="username">Username *</label>
        <input type="text" name="username" id="username" required>
        <label for="email">Email *</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Password *</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Register</button>
    </form>
    <?php if (isset($errorValue)): ?>
        <?php if ($errorValue == "email"): ?>
            <p style="color: orangered;">The email is not valid.</p>
        <?php elseif ($errorValue == "nodata"): ?>
            <p style="color: orangered;">Please enter your informations in the field.</p>
        <?php elseif ($errorValue == "exists"): ?>
            <p style="color: orangered;">An user already exists with this username or email.</p>
        <?php endif; ?>
    <?php endif; ?>
</main>