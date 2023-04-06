<?php

require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

require_once 'classes/SessionPermissionsUtils.php';

if (!SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'categories'))
{
    header('Location: categories_list.php?alert_type=3&alert_message=Neoprávněný přístup');
    die();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once 'classes/Database.php';

    $db = new Database();

    $sql = 'select count(*) as article_count from articles where category_id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);

    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count['article_count'] > 0) {
        header('Location: categories_list.php?alert_type=3&alert_message=Nelze smazat kategorii s více než 0 články');
        die();
    } else {
        $sql = 'delete from categories where id = :id';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':id' => $_GET['id'],
        ]);
    }

    header('Location: categories_list.php?alert_type=1&alert_message=Změna proběhla úspěšně');

}
else {
    header('Location: categories_list.php?alert_type=2&alert_message=Neplatný odkaz');
}

