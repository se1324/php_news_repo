<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/AlertUtils.php';

require_once 'classes/Database.php';
require_once 'classes/DateUtils.php';

require_once 'classes/SessionPermissionsUtils.php';
require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();

$db = new Database();

if ($auth->IsUserLoggedIn()) {
    $sql = 'SELECT *, 
        (select count(*) from articles where author_id = ath.id and is_published = 1) as articles_count_published,
        (select count(*) from articles where author_id = ath.id and is_published = 0) as articles_count_not_published,
        case ath.id when :current_user_id then 1 else 0 end as OWNED_BY_CURRENT_USER
        from authors ath
        order by OWNED_BY_CURRENT_USER DESC';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':current_user_id' => $auth->GetCurrentUserDetails()['user_id'],
    ]);
}
else {
    $sql = 'SELECT *, 
        (select count(*) from articles where author_id = ath.id and is_published = 1) as articles_count_published
        from authors ath';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute();
}
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
            <h1>Seznam autorů</h1>
        </div>
        <div class="mb-3 d-flex justify-content-end">
            <?php
                $canCreateProfile = $auth->IsUserLoggedIn() &&
                    SessionPermissionsUtils::CheckIfPermExistsOnResource('create', 'profiles');
            ?>

            <?php if($canCreateProfile): ?>
                <a href="authors_add.php" class="btn btn-success">Přidat autora</a>
            <?php endif; ?>
        </div>
        <div>
            <table class="table align-middle table-responsive">
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
                            <?php if ($auth->IsUserLoggedIn()): ?>
                                <?= $author['articles_count_published'].' veřejné, '.$author['articles_count_not_published'].' skryté' ?>
                            <?php else: ?>
                                <?= $author['articles_count_published'] ?>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?= DateUtils::DatumCesky($author['created_at']) ?>
                        </td>
                        <td class="text-end">
                            <?php
                                $canReadProfile = $auth->IsUserLoggedIn() &&
                                    (SessionPermissionsUtils::CheckIfPermExistsOnResource('read_own', 'profiles')
                                    && $author['OWNED_BY_CURRENT_USER'] == 1)
                                    || SessionPermissionsUtils::CheckIfPermExistsOnResource('read_all', 'profiles');

                                $canDeleteProfile = $auth->IsUserLoggedIn() &&
                                    (SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_own', 'profiles')
                                        && $author['OWNED_BY_CURRENT_USER'] == 1)
                                    || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'profiles');
                            ?>

                            <?php if ($canReadProfile): ?>
                                <a href="profile.php?id=<?= $author['id'] ?>" class="btn btn-primary">Zobrazit profil</a>
                            <?php endif; ?>

                            <?php if ($canDeleteProfile): ?>
                                <a href="authors_delete.php?id=<?= $author['id'] ?>" class="btn btn-danger">Smazat</a>
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
