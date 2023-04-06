<?php

require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    require_once 'classes/SessionPermissionsUtils.php';
    require_once 'classes/Database.php';

    $db = new Database();

    $sql = 'select author_id from articles where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
    $articleAuthorId = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!((SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_own', 'articles')
        && $articleAuthorId['author_id'] == $auth->GetCurrentUserDetails()['user_id'])
        || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'articles')))
    {
        header('Location: articles_list.php?alert_type=3&alert_message=Neoprávněný přístup');
        die();
    }

    $sql = 'delete from articles where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);

    header('Location: articles_list.php?alert_type=1&alert_message=Změna proběhla úspěšně');

}
else {
    header('Location: articles_list.php?alert_type=2&alert_message=Neplatný odkaz');
}

