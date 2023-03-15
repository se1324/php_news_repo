<?php

require_once 'classes/Database.php';

$db = new Database();

$sql = 'SELECT *, (select count(*) from articles where author_id = ath.id) as articles_count from authors ath';
$stmt = $db->conn->prepare($sql);
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Seznam autorů</title>

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
        <div class="mb-4">
            <h1>Seznam autorů</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <a href="authors_add.php" class="btn btn-success">Přidat autora</a>
        </div>
        <div>
            <table class="table align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Jméno a příjmení</th>
                        <th>Počet článků</th>
                        <th>Datum vytvoření</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($authors as $author): ?>
                    <tr>
                        <td>
                            <a href="authors_detail.php?id=<?= $author['id'] ?>">
                                <?= $author['name'].' '.$author['surname'] ?>
                            </a>
                        </td>
                        <td>
                            <?= $author['articles_count'] ?>
                        </td>
                        <td>
                            <?php
                            $fmt = datefmt_create('cs-CZ', IntlDateFormatter::FULL, IntlDateFormatter::SHORT);
                            echo $fmt->format(new DateTime($author['created_at']));
                            ?>
                        </td>
                        <td class="text-end">
                            <a href="authors_edit.php?id=<?= $author['id'] ?>" class="btn btn-primary">Upravit</a>
                            <a href="authors_delete.php?id=<?= $author['id'] ?>" class="btn btn-danger">Smazat</a>
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
