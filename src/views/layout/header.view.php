<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Workshop Classic Models</title>
</head>
<body>
<header>
    <nav style="padding: 0 5vw;">
        <ul>
            <li><a href="/"><strong>Classic Models</strong></a></li>
        </ul>
        <form action="/search" method="post" style="display: flex;align-items: center;">
            <input type="search" name="search" placeholder="Search..." style="border-radius: 10px 0 0 10px;">
            <button type="submit" style="border-radius: 0 10px 10px 0;">Search</button>
        </form>
        <ul>
            <?php if (isset($_SESSION) && isset($_SESSION['user'])): ?>
                <li><a href="profil">Bonjour <?= $_SESSION['user']['username'] ?></a></li>
                <li><a href="/logout">Logout</a></li>
            <?php else: ?>
                <li><a href="/login">Login</a></li>
                <li><a href="/register">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>