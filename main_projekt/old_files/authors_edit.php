<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    require_once 'classes/Database.php';
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
            $sql = 'UPDATE authors set name = :name, surname = :surname where id = :id';
            $stmt = $db->conn->prepare($sql);
            $stmt->execute([
                ':name' => $_POST['name'],
                ':surname' => $_POST['surname'],
                ':id' => $_GET['id'],
            ]);

            header('Location: authors_list.php');
            die();
        }
    }


    $sql = 'select * from authors where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
    $author = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($author == false) {
        header('Location: authors_list.php');
        die();
    }
}
else {
    header('Location: authors_list.php');
    die();
}

?>


<!doctype html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Úprava autora</title>

    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-11">
        <h1 class="mb-4">Úprava autora</h1>
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
                        <input type="text" class="form-control" name="name" value="<?= $author['name'] ?>" required maxlength="20">
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Příjmení:
                        <input type="text" class="form-control" name="surname" value="<?= $author['surname'] ?>" required maxlength="20">
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Uložit</button>
            </form>
        </div>
    </div>
</div>




<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>