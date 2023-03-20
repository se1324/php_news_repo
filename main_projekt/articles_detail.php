<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';
$db = new Database();

if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
    $sql = 'SELECT a.*, CONCAT(ath.name, " ", ath.surname) as author_fullname, c.id as cat_id, c.category_name from articles a 
            left join authors ath on a.author_id = ath.id 
            left join categories c on a.category_id = c.id
            where a.id = :article_id';

    $stmt = $db->conn->prepare($sql);

    $stmt->execute([
       ':article_id' => $_GET['article_id'],
    ]);

    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}
else {
    header('Location: index.php');
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
    <title>Detail článku</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/articles_detail.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-sm-10 col-lg-8">
        <div class="mb-4">
            <div class="mb-4 d-flex justify-content-end">
                <a href="articles_edit.php?id=<?= $article['id'] ?>" class="btn btn-primary me-1">Upravit článek</a>
                <a href="articles_delete.php?id=<?= $article['id'] ?>" class="btn btn-danger">Smazat článek</a>
            </div>
            <div class="ar_title mb-3">
                <?= $article['title'] ?>
            </div>
            <div class="ar_category mb-1">
                Kategorie:
                <a href="categories_detail.php?id=<?= $article['cat_id'] ?>"><?= $article['category_name'] ?></a>
            </div>
            <div class="ar_author_date mb-4">
                <time>
                    <?php
                    $fmt = datefmt_create('cs-CZ', IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
                    echo $fmt->format(new DateTime($article['created_at']));
                    ?>
                </time>
                <a href="authors_detail.php?id=<?= $article['author_id'] ?>"><?= $article['author_fullname'] ?></a>
            </div>
            <div class="ar_introduction mb-3 fs-4 fw-semibold">
                <?= $article['introduction'] ?>
            </div>
        </div>
        <main>
            <?= $article['content'] ?>
        </main>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
