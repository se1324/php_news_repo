<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';

$db = new Database();


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = 'SELECT * from categories where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
    $category = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = 'SELECT a.*,CONCAT(ath.name, " ", ath.surname) as author_fullname from articles a 
            left join authors ath on a.author_id = ath.id
            where a.is_published = 1 and a.category_id = :category_id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':category_id' => $_GET['id'],
    ]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else {
    header('Location: categories_list.php');
    die();
}




?>

<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail kategorie</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid px-5">
    <h1 class="mb-4">Kategorie: <?= $category['category_name']?></h1>
    <hr class="border border-dark border-2 opacity-75 mb-4">
    <div class="row flex-column">
        <div class="col-6">
            <?php if(empty($articles)): ?>
                <h2>Kategorie neobsahuje žádné články</h2>
            <?php else: ?>
                <?php foreach ($articles as $article): ?>
                    <div class="card mb-5">
                        <div class="card-body">
                            <h5 class="card-title ar_title mb-3">
                                <a href="articles_detail.php?article_id=<?= $article['id'] ?>">
                                    <?= $article['title'] ?>
                                </a>
                            </h5>
                            <h6 class="card-subtitle mb-3 text-muted">
                                <time>
                                    <?php
                                    $fmt = datefmt_create('cs-CZ', IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
                                    echo $fmt->format(new DateTime($article['created_at']));
                                    ?>
                                </time>
                                <a href="authors_detail.php?id=<?= $article['author_id'] ?>"><?= $article['author_fullname'] ?></a>
                            </h6>
                            <p class="card-text mb-3">
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
            <?php endif; ?>
        </div>
    </div>
</div>



<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>