<?php

require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

require_once 'classes/SessionPermissionsUtils.php';

if (!SessionPermissionsUtils::CheckIfPermExistsOnResource('create', 'profiles')) {
    header('Location: authors_list.php?alert_type=3&alert_message=Neoprávněný přístup');
    die();
}

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

    if (empty($_POST['username'])) {
        $errors[] = 'Uživ.jm. je povinné';
    }
    else {
        if (strlen($_POST['username']) > 50) {
            $errors[] = 'Uživ.jm. může mít max. 50 znaků';
        }
    }

    if (empty($_POST['password'])) {
        $errors[] = 'Heslo je povinné';
    }
    else {
        if (strlen($_POST['password']) > 20) {
            $errors[] = 'Heslo může mít max. 20 znaků';
        }
    }

    if (empty($errors)) {
        require_once 'classes/UserUtils.php';

        UserUtils::CreateNewUser($_POST['name'], $_POST['surname'], $_POST['username'], $_POST['password']);

        header('Location: authors_list.php?alert_type=1&alert_message=Změna proběhla úspěšně');
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

<?php include_once 'reusable_components/navbar.php'; ?>

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
                    <label class="form-label">Jméno
                        <input type="text" class="form-control" name="name" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Příjmení
                        <input type="text" class="form-control" name="surname" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Uživatelské jméno
                        <input type="text" class="form-control" name="username" required>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Heslo
                        <input type="text" class="form-control" name="password" required>
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