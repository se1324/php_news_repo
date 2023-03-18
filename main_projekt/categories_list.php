<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/Database.php';

$db = new Database();

$sql = 'SELECT ctg.*, (select count(*) from articles where category_id = ctg.id) as articles_count from categories ctg';
$stmt = $db->conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

$showerror = false;
if (isset($_GET['prevent_deletion_category_id']) && is_numeric($_GET['prevent_deletion_category_id'])) {
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
    <title>Seznam kategorií</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-7">
        <?php if($showerror): ?>
            <div class="alert alert-danger" role="alert">
                Nelze smazat kategorii s více než 0 články!
            </div>
        <?php endif; ?>
        <div class="mb-4">
            <h1>Seznam kategorií</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <a href="categories_add.php" class="btn btn-success">Přidat kategorii</a>
        </div>
        <div>
            <table class="table align-middle">
                <thead class="table-dark">
                <tr>
                    <th>Název kategorie</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($categories as $category): ?>
                    <tr>
                        <td>
                            <a href="categories_detail.php?id=<?= $category['id'] ?>">
                                <?= $category['category_name'] ?>
                            </a>
                        </td>
                        <td class="text-end">
                            <a href="categories_edit.php?id=<?= $category['id'] ?>" class="btn btn-primary">Upravit</a>
                            <a href="categories_delete.php?id=<?= $category['id'] ?>" class="btn btn-danger">Smazat</a>
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
