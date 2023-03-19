<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    require_once 'classes/Database.php';

    $db = new Database();


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
    }
}

header('Location: authors_list.php');

