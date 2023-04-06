<?php

require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    require_once 'classes/SessionPermissionsUtils.php';
    require_once 'classes/Database.php';

    $db = new Database();


    if (!((SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_own', 'profiles')
            && $_GET['id'] == $auth->GetCurrentUserDetails()['user_id'])
        || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'profiles')))
    {
        header('Location: authors_list.php?alert_type=3&alert_message=Neoprávněný přístup');
        die();
    }


    $sql = 'select count(*) as article_count from articles where author_id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);

    $count = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($count['article_count'] > 0) {
        header('Location: authors_list.php?alert_type=3&alert_message=Nelze smazat autora s více než 0 články');
        die();
    }
    else {
        $sql = 'delete from authors where id = :id';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':id' => $_GET['id'],
        ]);

        if ($_GET['id'] == $auth->GetCurrentUserDetails()['user_id']) {
            //uživatel je smazán, zničí se jen session
            $auth->Logout();
        }
    }

    header('Location: authors_list.php?alert_type=1&alert_message=Změna proběhla úspěšně');

}
else {
    header('Location: authors_list.php?alert_type=2&alert_message=Neplatný odkaz');
}


