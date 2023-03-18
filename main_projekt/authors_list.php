<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';

$db = new Database();

$sql = 'SELECT *, 
        (select count(*) from articles where author_id = ath.id and is_published = 1) as articles_count_published,
        (select count(*) from articles where author_id = ath.id and is_published = 0) as articles_count_not_published
        from authors ath';
$stmt = $db->conn->prepare($sql);
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

$showerror = false;
if (isset($_GET['prevent_deletion_author_id']) && is_numeric($_GET['prevent_deletion_author_id'])) {
    $showerror = true;
}
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

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-7">
        <?php if($showerror): ?>
        <div class="alert alert-danger" role="alert">
            Nelze smazat autora s více než 0 články!
        </div>
        <?php endif; ?>
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
                            <?= $author['articles_count_published'].' veřejné, '.$author['articles_count_not_published'].' skryté' ?>
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
