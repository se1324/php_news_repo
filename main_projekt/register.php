<?php

require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();

if ($auth->IsUserLoggedIn()) {
    header('Location: index.php');
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    if (!isset($_POST['name']) ||
        (isset($_POST['name']) && strlen($_POST['name']) == 0)) {
        $errors[] = "Jméno je povinné";
    }

    if (!isset($_POST['surname']) ||
        (isset($_POST['surname']) && strlen($_POST['surname']) == 0)) {
        $errors[] = "Příjmení je povinné";
    }

    if (!isset($_POST['username']) ||
        (isset($_POST['username']) && strlen($_POST['username']) == 0)) {
            $errors[] = "Uživ. jm. je povinné";
        }

    if (!isset($_POST['password']) ||
        (isset($_POST['password']) && strlen($_POST['password']) == 0)) {
        $errors[] = "Heslo je povinné";
    }

    if (empty($errors)) {

        require_once 'classes/Database.php';
        $db = new Database();
        $sql = 'select count(*) as users_count from authors where username = :username';
        $stmt = $db->conn->prepare($sql);
        $stmt->execute([
           ':username' => $_POST['username'],
        ]);
        $foundUsersCount = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($foundUsersCount['users_count'] == 0) {
            $auth->Register($_POST['username'], $_POST['password'], $_POST['name'], $_POST['surname']);

            header('Location: index.php');
            die();
        }
    }
}


?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrace</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-6">

            <?php if (isset($foundUsersCount['users_count']) && $foundUsersCount['users_count'] > 0): ?>
                <div class="alert alert-warning">Uživatelské jméno již existuje</div>
            <?php endif; ?>

            <h1 class="mb-4 display-3 text-center">
                Registrace
            </h1>
            <?php if (!empty($errors)): ?>
            <div class="d-flex justify-content-center">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>
            <div class="mb-4">
                <form method="post">
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="form-label">Jméno
                            <input type="text" class="form-control form-control-lg" name="name" value="<?= $_POST['name'] ?? '' ?>" required>
                        </label>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="form-label">Příjmení
                            <input type="text" class="form-control form-control-lg" name="surname" value="<?= $_POST['surname'] ?? '' ?>" required>
                        </label>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="form-label">Nové uživatelské jméno
                            <input type="text" class="form-control form-control-lg" name="username" value="<?= $_POST['username'] ?? '' ?>" required>
                        </label>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="form-label">Nové heslo
                            <input type="text" class="form-control form-control-lg" name="password" value="<?= $_POST['password'] ?? '' ?>" required>
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary">Registrovat</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>