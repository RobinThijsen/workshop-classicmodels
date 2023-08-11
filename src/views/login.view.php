<main class="container">
    <form action="#" method="post">
        <label for="email">Email *</label>
        <input type="email" name="email" id="email" required>
        <label for="password">Password *</label>
        <input type="password" name="password" id="password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($errorValue)): ?>
        <?php if ($errorValue == "not-exist"): ?>
            <p style="color: orangered;">This user doesn't exist.</p>
        <?php elseif ($errorValue == "wrong-pwd"): ?>
            <p style="color: orangered;">The password is not valid.</p>
        <?php elseif ($errorValue == "wrong-email"): ?>
            <p style="color: orangered;">The email is not valid.</p>
        <?php elseif ($errorValue == "nodata"): ?>
            <p style="color: orangered;">Please enter your informations in the field.</p>
        <?php endif; ?>
    <?php endif; ?>
</main>