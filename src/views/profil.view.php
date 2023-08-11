<?php extract($user); ?>
<main class="container">
    <h2><?= $username ?> informations</h2>
    <form action="#" method="post">
        <label for="username">Username *</label>
        <input type="text" name="username" value="<?= $username ?>" id="username" placeholder="Username..." required>
        <label for="email">Email *</label>
        <input type="email" name="email" value="<?= $email ?>" id="email" placeholder="Email..." required>
        <label for="cPassword">Confirm modification *</label>
        <input type="password" name="cPassword" id="cPassword" placeholder="Confirm modification with your password..." required>
        <button type="submit">Modify</button>
    </form>
    <?php if (isset($errorValue)): ?>
        <?php if ($errorValue == "nodata"): ?>
            <p style="color: orangered;">Please enter your informations in the field.</p>
        <?php elseif ($errorValue == "email"): ?>
            <p style="color: orangered;">The email is not valid.</p>
        <?php elseif ($errorValue == "pass"): ?>
            <p style="color: orangered;">The password is not valid.</p>
        <?php endif; ?>
    <?php elseif (isset($success)): ?>
        <p style="color: limegreen;">Your modification as been saved successfully.</p>
    <?php endif; ?>
    <a href="/delete" role="button" class="outline" style="border-color: orangered;color: orangered;">Delete profile</a>
</main>