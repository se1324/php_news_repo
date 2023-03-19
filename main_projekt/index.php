<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';

$db = new Database();

$sql = 'SELECT a.*,CONCAT(ath.name, " ", ath.surname) as author_fullname, c.id as cat_id, c.category_name from articles a 
        left join authors ath on a.author_id = ath.id 
        left join categories c on a.category_id = c.id
        where a.is_published = 1
        ORDER by a.created_at DESC 
        LIMIT 5';
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

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-7">
        <div class="mb-5 articles_title">
            <h1>Články</h1>
            <p>Nejnovější zprávy</p>
        </div>
        <div class="d-flex justify-content-center flex-column">
            <?php foreach ($articles as $article): ?>
                <div class="card mb-5">
                    <div class="card-body">
                        <h5 class="card-title ar_title mb-3">
                            <a href="articles_detail.php?article_id=<?= $article['id'] ?>">
                                <?= $article['title'] ?>
                            </a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            Kategorie:
                            <a href="categories_detail.php?id=<?= $article['cat_id'] ?>"><?= $article['category_name'] ?></a>
                        </h6>
                        <h6 class="card-subtitle mb-3 text-muted">
                            <time>
                                <?php
                                $fmt = datefmt_create('cs-CZ', IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
                                echo $fmt->format(new DateTime($article['created_at']));
                                ?>
                            </time>
                            <a href="authors_detail.php?id=<?= $article['author_id'] ?>"><?= $article['author_fullname'] ?></a>
                        </h6>
                        <p class="card-text mb-3 fw-semibold fs-5">
                            <?= $article['introduction'] ?>
                        </p>
                        <a href="articles_detail.php?article_id=<?= $article['id'] ?>" class="card-link btn btn-primary">Číst dál
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
