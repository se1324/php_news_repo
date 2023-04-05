<?php

header('Cache-Control: no-store, no-cache, max-age=0, must-revalidate');

require_once 'classes/AuthHandler.php';
require_once 'classes/SessionPermissionsUtils.php';
$auth = new AuthHandler();
$auth->CheckIfConnectionAllowed();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    if (!((SessionPermissionsUtils::CheckIfPermExistsOnResource('read_own', 'profiles')
        && $_GET['id'] == $auth->GetCurrentUserDetails()['user_id'])
        || SessionPermissionsUtils::CheckIfPermExistsOnResource('read_all', 'profiles')))
    {
        header('Location: index.php');
        die();
    }

    $canWrite = (SessionPermissionsUtils::CheckIfPermExistsOnResource('write_own', 'profiles')
            && $_GET['id'] == $auth->GetCurrentUserDetails()['user_id'])
        || SessionPermissionsUtils::CheckIfPermExistsOnResource('write_all', 'profiles');

    if ($canWrite)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            unset($_GET['showsuccess']);
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

            if (isset($_POST['has_new_password'])) {
                if (!isset($_POST['password']) ||
                    (isset($_POST['password']) && strlen($_POST['password']) == 0)) {
                    $errors[] = "Heslo je povinné";
                }
            }

            if (empty($errors)) {
                $setNewPassword = false;
                if (isset($_POST['has_new_password'])) {
                    $setNewPassword = true;
                }

                $auth->UpdateUserDetails($_GET['id'], $_POST['name'], $_POST['surname'], $_POST['username'], $_POST['password'], $setNewPassword);

                header('Location: profile.php?showsuccess=1&id='.$_GET['id']);
                die();
            }
        }
    }

    require_once 'classes/Database.php';
    $db = new Database();

    $sql = 'select * from authors where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
    $userInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userInfo == false) {
        header('Location: index.php');
        die();
    }

}
else {
    header('Location: index.php');
    die();
}




?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil uživatele</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid px-5">
    <h1 class="mb-4">Profil uživatele: <?= $userInfo['name'].' '.$userInfo['surname'] ?></h1>
    <hr class="border border-dark border-2 opacity-75 mb-4">
    <div class="mb-4">
        <?php if (isset($_GET['showsuccess']) && $_GET['showsuccess'] == 1): ?>
            <div class="alert alert-success">
                Změna proběhla úspěšně!
            </div>
        <?php endif; ?>
        <h2 class="mb-4">Osobní údaje</h2>
        <?php if (!empty($errors)): ?>
            <div class="mb-4">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php if ($canWrite): ?>
            <div>
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Jméno
                            <input type="text" class="form-control form-control-lg" name="name" value="<?= $userInfo['name'] ?>" required>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Příjmení
                            <input type="text" class="form-control form-control-lg" name="surname" value="<?= $userInfo['surname'] ?>" required>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Uživ. jm.
                            <input type="text" class="form-control form-control-lg" name="username" value="<?= $userInfo['username'] ?>" required>
                        </label>
                    </div>
                    <div class="mb-3">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" id="hasNewPassword" name="has_new_password" value="1">
                            Chci změnit heslo
                        </label>
                    </div>
                    <div class="mb-3" id="passwordFieldContainer">
                        <label class="form-label">Nové heslo
                            <input type="text" class="form-control form-control-lg" id="newPasswordField" name="password" placeholder="Vyplňte nové heslo">
                        </label>
                    </div>
                    <button class="btn btn-warning">Uložit</button>
                </form>
            </div>
        <?php else: ?>
            <div>
                <div class="mb-3">
                    <label class="form-label">Jméno
                        <input type="text" class="form-control form-control-lg" value="<?= $userInfo['name'] ?>" disabled readonly>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Příjmení
                        <input type="text" class="form-control form-control-lg" value="<?= $userInfo['surname'] ?>" disabled readonly>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">Uživ. jm.
                        <input type="text" class="form-control form-control-lg" value="<?= $userInfo['username'] ?>" disabled readonly>
                    </label>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <hr class="border border-dark border-2 opacity-75 mb-4">
    <div>
        <a href="authors_detail.php?id=<?= $userInfo['id'] ?>" class="btn btn-primary">Zobrazit články</a>
    </div>
</div>

<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>

<?php if ($canWrite): ?>
    <script>
        const passwordCheck = document.getElementById('hasNewPassword');
        const passwordInput = document.getElementById('newPasswordField');
        const passwordContainer = document.getElementById('passwordFieldContainer');

        passwordContainer.style.display = 'none';

        passwordCheck.addEventListener('change', function () {
            if (this.checked) {
                passwordContainer.style.display = 'block';
                passwordInput.setAttribute('required', '');
            }
            else {
                passwordContainer.style.display = 'none';
                passwordInput.removeAttribute('required');
            }
        })
    </script>
<?php endif; ?>
</body>
</html>