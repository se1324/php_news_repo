<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';
require_once 'classes/DateUtils.php';

$db = new Database();


if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $sql = 'SELECT * from authors where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
    $author = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($author == false) {
        header('Location: authors_list.php');
        die();
    }


    $sql = 'SELECT a.*, c.id as cat_id, c.category_name from articles a 
            left join categories c on a.category_id = c.id
            where a.is_published = 1 and a.author_id = :author_id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':author_id' => $_GET['id'],
    ]);
    $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
else {
    header('Location: authors_list.php');
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
    <title>Detail autora</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid px-5">
    <h1 class="mb-4">Články autora: <?= $author['name'].' '.$author['surname'] ?></h1>
    <hr class="border border-dark border-2 opacity-75 mb-4">
    <div class="row flex-column">
        <div class="col-sm-9 col-lg-6">
            <?php if(empty($articles)): ?>
                <h2>Žádné veřejně dostupné články</h2>
            <?php else: ?>
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
                                    <?= DateUtils::DatumCesky($article['created_at']) ?>
                                </time>
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
            <?php endif; ?>
        </div>
    </div>
</div>



<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>