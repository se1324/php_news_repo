<?php

if (isset($_GET['id']) && is_numeric($_GET['id']))
{
    require_once 'classes/Database.php';

    $db = new Database();

    $sql = 'delete from articles where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
}

header('Location: articles_list.php');
