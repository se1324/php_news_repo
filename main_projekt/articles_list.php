<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/AlertUtils.php';

require_once 'classes/Database.php';
require_once 'classes/DateUtils.php';

require_once 'classes/SessionPermissionsUtils.php';
require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

$db = new Database();

$sql = 'select a.id, a.title, a.is_published, a.created_at,
        ath.id as author_id, concat(ath.name, " ", ath.surname) as author_fullname,
        c.id as category_id, c.category_name,
        case ath.id when :my_id then 1 else 0 end as OWNED_BY_CURRENT_USER
        from articles a
        left join authors ath on a.author_id = ath.id
        left join categories c on a.category_id = c.id
        order by OWNED_BY_CURRENT_USER DESC, a.created_at desc';
$stmt = $db->conn->prepare($sql);
$stmt->execute([
        ':my_id' => $auth->GetCurrentUserDetails()['user_id'],
]);
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

        <?php
            if (isset($_GET['alert_type'], $_GET['alert_message']) &&
                is_numeric($_GET['alert_type']) && is_string($_GET['alert_message']))
            {
                AlertUtils::CreateAlert($_GET['alert_type'], $_GET['alert_message']);
            }
        ?>

        <div class="mb-4">
            <h1>Správa článků</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <?php
                $canCreateArticles = SessionPermissionsUtils::CheckIfPermExistsOnResource('create', 'articles');
            ?>

            <?php if ($canCreateArticles): ?>
                <a href="articles_add.php" class="btn btn-success">Přidat článek</a>
            <?php endif; ?>
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
                            <?= DateUtils::DatumCesky($article['created_at']) ?>
                        </td>
                        <td>
                            <?php
                            if ($article['is_published'] == '1') {
                                echo "Ano";
                            }
                            else {
                                echo "Ne";
                            }
                            ?>
                        </td>
                        <td class="text-end">
                            <?php
                                $canEditArticles =
                                    (SessionPermissionsUtils::CheckIfPermExistsOnResource('write_own', 'articles')
                                        && $article['OWNED_BY_CURRENT_USER'] == 1)
                                    || SessionPermissionsUtils::CheckIfPermExistsOnResource('write_all', 'articles');

                                $canDeleteArticles =
                                    (SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_own', 'articles')
                                        && $article['OWNED_BY_CURRENT_USER'] == 1)
                                    || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'articles');
                            ?>

                            <?php if ($canEditArticles): ?>
                                <a href="articles_edit.php?id=<?= $article['id'] ?>" class="btn btn-primary">Upravit</a>
                            <?php endif; ?>

                            <?php if ($canDeleteArticles): ?>
                                <a href="articles_delete.php?id=<?= $article['id'] ?>" class="btn btn-danger">Smazat</a>
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
