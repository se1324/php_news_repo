<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Přihlásit se</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/index.css">
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="mb-4 display-3 text-center">
                Přihlásit se
            </h1>
            <div class="mb-4">
                <form method="post">
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="form-label">Username
                            <input type="text" class="form-control form-control-lg" name="username">
                        </label>
                    </div>
                    <div class="mb-3 d-flex justify-content-center">
                        <label class="form-label">Password
                            <input type="text" class="form-control form-control-lg" name="password">
                        </label>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button class="btn btn-primary">Přihlásit se</button>
                    </div>
                </form>
            </div>
            <div class="d-flex justify-content-center">
                <a href="register.php">Nemám účet</a>
            </div>
        </div>
    </div>
</div>


<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>