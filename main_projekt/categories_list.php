<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/AlertUtils.php';

require_once 'classes/Database.php';
require_once 'classes/SessionPermissionsUtils.php';

$db = new Database();

$sql = 'SELECT ctg.*, (select count(*) from articles where category_id = ctg.id) as articles_count from categories ctg';
$stmt = $db->conn->prepare($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <div class="col-sm-10 col-lg-7">

        <?php
        if (isset($_GET['alert_type'], $_GET['alert_message']) &&
            is_numeric($_GET['alert_type']) && is_string($_GET['alert_message']))
        {
            AlertUtils::CreateAlert($_GET['alert_type'], $_GET['alert_message']);
        }
        ?>

        <div class="mb-4">
            <h1>Seznam kategorií</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <?php
                $canCreateCategories =
                    SessionPermissionsUtils::CheckIfPermExistsOnResource('create', 'categories');
            ?>

            <?php if ($canCreateCategories): ?>
                <a href="categories_add.php" class="btn btn-success">Přidat kategorii</a>
            <?php endif; ?>
        </div>
        <div>
            <table class="table align-middle table-responsive">
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
                            <?php
                                $canEditCategories =
                                    SessionPermissionsUtils::CheckIfPermExistsOnResource('write_all', 'categories');

                                $canDeleteCategories =
                                    SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'categories');
                            ?>

                            <?php if ($canEditCategories): ?>
                                <a href="categories_edit.php?id=<?= $category['id'] ?>" class="btn btn-primary">Upravit</a>
                            <?php endif; ?>

                            <?php if ($canDeleteCategories): ?>
                                <a href="categories_delete.php?id=<?= $category['id'] ?>" class="btn btn-danger">Smazat</a>
                            <?php endif; ?>
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
