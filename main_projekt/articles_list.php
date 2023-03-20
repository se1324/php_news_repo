<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';

$db = new Database();

$sql = 'select a.id, a.title, a.is_published, a.created_at,
        ath.id as author_id, concat(ath.name, " ", ath.surname) as author_fullname,
        c.id as category_id, c.category_name
        from articles a
        left join authors ath on a.author_id = ath.id
        left join categories c on a.category_id = c.id
        order by a.title asc';
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
    <title>Seznam všech článků</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-sm-10 col-lg-7">
        <div class="mb-4">
            <h1>Správa článků</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <a href="articles_add.php" class="btn btn-success">Přidat článek</a>
        </div>
        <div>
            <table class="table align-middle table-responsive">
                <thead class="table-dark">
                <tr>
                    <th class="w-25">Titulek</th>
                    <th>Autor</th>
                    <th>Kategorie</th>
                    <th>Datum vytvoření</th>
                    <th>Zveřejněný</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($articles as $article): ?>
                    <tr>
                        <td>
                            <a href="articles_detail.php?article_id=<?= $article['id'] ?>">
                                <?= $article['title'] ?>
                            </a>
                        </td>
                        <td>
                            <a href="authors_detail.php?id=<?= $article['author_id'] ?>">
                                <?= $article['author_fullname'] ?>
                            </a>
                        </td>
                        <td>
                            <a href="categories_detail.php?id=<?= $article['category_id'] ?>">
                                <?= $article['category_name'] ?>
                            </a>
                        </td>
                        <td>
                            <?php
                            $fmt = datefmt_create('cs-CZ', IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
                            echo $fmt->format(new DateTime($article['created_at']));
                            ?>
                        </td>
                        <td>
                            <?php
                            if ($article['is_published'] == true) {
                                echo "Ano";
                            }
                            else {
                                echo "Ne";
                            }
                            ?>
                        </td>
                        <td class="text-end">
                            <a href="articles_edit.php?id=<?= $article['id'] ?>" class="btn btn-primary">Upravit</a>
                            <a href="articles_delete.php?id=<?= $article['id'] ?>" class="btn btn-danger">Smazat</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
