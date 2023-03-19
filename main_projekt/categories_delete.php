<?php


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
        header('Location: categories_list.php?prevent_deletion_category_id=' . $_GET['id']);
        die();
    } else {
        $sql = 'delete from categories where id = :id';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':id' => $_GET['id'],
        ]);
    }
}

header('Location: categories_list.php');
