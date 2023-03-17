<?php

require_once 'classes/Database.php';

$db = new Database();

$sql = 'SELECT a.*,CONCAT(ath.name, " ", ath.surname) as author_fullname from articles a left join authors ath on a.author_id = ath.id';
$stmt = $db->conn->prepare($sql);
$stmt->execute();
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hlavní stránka</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-nav">
            <a class="nav-link active" href="index.php">Zprávy</a>
            <a class="nav-link" href="#">Kategorie</a>
            <a class="nav-link" href="authors_list.php">Autoři</a>
            <a class="nav-link" href="#">Administrace článků</a>
            <a class="nav-link" href="#">Přidat článek</a>
        </div>
    </div>
</nav>


<div class="container-fluid row justify-content-center">
    <div class="col-7">
        <div class="mb-5 articles_title">
            <h1>Články</h1>
            <p>Nejnovější zprávy</p>
        </div>
        <div class="d-flex justify-content-center flex-column">
            <?php foreach ($articles as $article): ?>
                <div class="mb-3">
                    <div class="ar_title mb-2">
                        <a href="articles_detail.php?article_id=<?= $article['id'] ?>">
                            <?= $article['title'] ?>
                        </a>
                    </div>
                    <div class="ar_author_date mb-2">
                        <time><?= (new DateTime($article['created_at']))->format("d.m.Y H:i") ?></time>
                        <a href="authors_detail.php?id=<?= $article['author_id'] ?>"><?= $article['author_fullname'] ?></a>
                    </div>
                    <div class="ar_introduction mb-3">
                        <?= $article['introduction'] ?>
                    </div>
                    <div class="d-flex justify-content-end ar_more">
                        <a href="articles_detail.php?article_id=<?= $article['id'] ?>">Číst dál
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>


<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
