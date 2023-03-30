<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';
require_once 'classes/DateUtils.php';

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

    if ($article == false) {
        header('Location: index.php');
        die();
    }
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
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-sm-10 col-lg-9 p-4">
        <div class="mb-4">
            <div class="mb-5 d-flex justify-content-between">
                <div>
                    <a href="index.php" class="btn btn-primary">Zpět na hlavní stránku</a>
                </div>
                <div>
                    <a href="articles_edit.php?id=<?= $article['id'] ?>&redirect=articles_detail" class="btn btn-primary me-1">Upravit článek</a>
                    <a href="articles_delete.php?id=<?= $article['id'] ?>" class="btn btn-danger">Smazat článek</a>
                </div>
            </div>
            <div class="display-5 fw-bold mb-4">
                <?= $article['title'] ?>
            </div>
            <div class="text-muted fw-semibold mb-1">
                Kategorie:
                <a href="categories_detail.php?id=<?= $article['cat_id'] ?>"><?= $article['category_name'] ?></a>
            </div>
            <div class="text-muted fw-semibold mb-4">
                <time>
                    <?= DateUtils::DatumCesky($article['created_at']) ?>
                </time>
                <a href="authors_detail.php?id=<?= $article['author_id'] ?>"><?= $article['author_fullname'] ?></a>
            </div>
            <hr class="border border-dark border-1 opacity-75 mb-4">
            <div class="ar_introduction mb-3 fs-3 fw-bold">
                <?= $article['introduction'] ?>
            </div>
        </div>
        <div>
            <?= $article['content'] ?>
        </div>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
