<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    require_once 'classes/Database.php';
    $db = new Database();


    $errors = [];
    if (empty($_POST['category_name'])) {
        $errors[] = 'Název je povinný';
    }
    else {
        if (strlen($_POST['category_name']) > 50) {
            $errors[] = 'Název může mít max. 50 znaků';
        }
    }

    if (empty($errors)) {
        $sql = 'INSERT into categories (category_name) values (:name)';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
            ':name' => $_POST['category_name'],
        ]);

        header('Location: categories_list.php');
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
    <title>Přidání nové kategorie</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-11">
        <h1 class="mb-4">Přidání kategorie</h1>
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
                        Název kategorie:
                        <input type="text" class="form-control" name="category_name" required maxlength="50">
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