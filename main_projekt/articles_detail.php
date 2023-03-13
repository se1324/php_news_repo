<?php
spl_autoload_register(function ($class) {
    require "classes/{$class}.php";
});

$db = new Database();

if (isset($_GET['article_id'])) {
    $sql = 'SELECT a.*, CONCAT(ath.name, " ", ath.surname) as author_fullname from articles a left join authors ath on a.author_id = ath.id where a.id = :article_id';

    $stmt = $db->conn->prepare($sql);

    $stmt->execute([
       ':article_id' => $_GET['article_id'],
    ]);

    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}



?>


<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail článku</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/articles_detail.css">
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-nav">
            <a class="nav-link active" href="index.php">Zprávy</a>
            <a class="nav-link" href="#">Kategorie</a>
            <a class="nav-link" href="#">Autoři</a>
            <a class="nav-link" href="#">Administrace článků</a>
            <a class="nav-link" href="#">Přidat článek</a>
        </div>
    </div>
</nav>


<div class="container-fluid article_container">
    <div class="mb-5">
        <div class="ar_title mb-2">
            <?= $article['title'] ?>
        </div>
        <div class="ar_author_date mb-2">
            <time><?= (new DateTime($article['created_at']))->format("d.m.Y H:i") ?></time>
            <a href=""><?= $article['author_fullname'] ?></a>
        </div>
        <div class="ar_introduction mb-3">
            <?= $article['introduction'] ?>
        </div>
    </div>
    <main>
        <?= $article['content'] ?>
    </main>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
