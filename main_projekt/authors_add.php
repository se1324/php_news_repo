<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once 'classes/Database.php';
    $db = new Database();

    $errors = [];
    if (empty($_POST['name'])) {
        $errors[] = 'Jméno je povinné';
    }
    else {
        if (strlen($_POST['name']) > 20) {
            $errors[] = 'Jméno může mít max. 20 znaků';
        }
    }

    if (empty($_POST['surname'])) {
        $errors[] = 'Příjmení je povinné';
    }
    else {
        if (strlen($_POST['name']) > 20) {
            $errors[] = 'Příjmení může mít max. 20 znaků';
        }
    }

    if (empty($errors)) {
        $sql = 'INSERT into authors (name, surname, created_at) 
            values (:name, :surname, default)';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':name' => $_POST['name'],
            ':surname' => $_POST['surname'],
        ]);

        header('Location: authors_list.php');
        die();
    }
}

?>


<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Přidání nového autora</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-nav">
            <a class="nav-link" href="index.php">Zprávy</a>
            <a class="nav-link" href="categories_list.php">Kategorie</a>
            <a class="nav-link active" href="authors_list.php">Autoři</a>
            <a class="nav-link" href="#">Administrace článků</a>
            <a class="nav-link" href="#">Přidat článek</a>
        </div>
    </div>
</nav>

<div class="container-fluid row justify-content-center">
    <div class="col-11">
        <h1 class="mb-4">Přidat autora</h1>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div>
            <form method="post">
                <div class="mb-3">
                    <label>
                        Jméno:
                        <input type="text" class="form-control" name="name" required maxlength="20">
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Příjmení:
                        <input type="text" class="form-control" name="surname" required maxlength="20">
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Přidat</button>
            </form>
        </div>
    </div>
</div>




<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>