<?php

require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    require_once 'classes/SessionPermissionsUtils.php';
    require_once 'classes/Database.php';

    $db = new Database();


    if (((SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_own', 'authors')
            || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_own', 'profiles'))
            && $_GET['id'] == $auth->GetCurrentUserDetails()['user_id'])
        || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'authors')
        || SessionPermissionsUtils::CheckIfPermExistsOnResource('delete_all', 'profiles'))
    {
        $sql = 'select count(*) as article_count from articles where author_id = :id';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':id' => $_GET['id'],
        ]);

        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($count['article_count'] > 0) {
            header('Location: authors_list.php?prevent_deletion_author_id='.$_GET['id']);
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
    }
}

header('Location: authors_list.php');

