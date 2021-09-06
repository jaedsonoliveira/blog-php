<?php require "config.php"; ?>
<html>
    <head>
        <title>Blog</title>
        <link rel="stylesheet" href="assets/css/style.css">
        <script type="text/javascript" src="assets/js/script.js"></script>
    </head>
    <body>
        <header>
        <nav>
            <div class="container">
                <div class="logo">
                    <a href="/">Blog</a>
                </div>

                <div class="menu">
                    <ul>
                        <?php if(isset($_SESSION['cLogin']) && !empty($_SESSION['cLogin'])) : ?>
                        <li><a href="meus-posts.php">Meus Posts</a></li>
                        <li><a href="sair.php">Sair</a></li>
                        <?php else: ?>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="cadastre-se.php">Cadastrar</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
</header>