<?php

require_once 'classes/SessionPermissionsUtils.php';
require_once 'classes/AuthHandler.php';
$auth = new AuthHandler();

$currentUserInfo = $auth->GetCurrentUserDetails();

?>



<nav class="navbar navbar-expand-lg bg-primary mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-nav">
		<?php $base = basename($_SERVER["SCRIPT_FILENAME"], '.php'); ?>
            <a class="nav-link
            <?php
            if ($base == 'index' || $base == 'articles_detail') {
                echo "active";
            }
            ?>" href="index.php">Zprávy</a>

            <a class="nav-link
            <?php
            if ($base == 'categories_list' || $base == 'categories_detail' || $base == 'categories_edit' || $base == 'categories_add') {
                echo "active";
            }
            ?>" href="categories_list.php">Kategorie</a>
            <a class="nav-link
            <?php
            if ($base == 'authors_list' || $base == 'authors_detail' || $base == 'authors_edit' || $base == 'authors_add') {
                echo "active";
            }
            ?>" href="authors_list.php">Autoři</a>

            <?php if (isset($currentUserInfo['logged_in']) && $currentUserInfo['logged_in'] == true): ?>
                <a class="nav-link
                <?php
                if ($base == 'articles_list' || $base == 'articles_edit' || $base == 'articles_add') {
                    echo "active";
                }
                ?>" href="articles_list.php">Administrace článků</a>
            <?php endif; ?>
        </div>

        <div class="navbar-nav">
            <?php if (!isset($currentUserInfo['logged_in'])
            || (isset($currentUserInfo['logged_in']) && $currentUserInfo['logged_in'] == false)): ?>
                <a class="nav-link
                    <?php
                    if ($base == 'login') {
                        echo "active";
                    }
                    ?>" href="login.php">Přihlásit se</a>
                <a class="nav-link
                    <?php
                    if ($base == 'register') {
                        echo "active";
                    }
                    ?>" href="register.php">Registrace</a>
            <?php endif; ?>
            <?php if (isset($currentUserInfo['logged_in']) && $currentUserInfo['logged_in'] == true): ?>
                <?php if (SessionPermissionsUtils::CheckIfPermExistsOnResource('read_own', 'profiles')
                        || SessionPermissionsUtils::CheckIfPermExistsOnResource('read_all', 'profiles')): ?>
                <a href="profile.php?id=<?= $currentUserInfo['user_id']?>" class="btn btn-success d-flex justify-content-between align-items-center gap-2 me-2
                    <?php
                        if ($base == 'profile') {
                            echo "fw-bold";
                        }
                    ?>
                    ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <?= $currentUserInfo['username'] ?>
                </a>
                <?php else: ?>
                <span class="bg-dark text-light py-2 px-3 rounded-2 d-flex justify-content-between align-items-center gap-2 me-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                    </svg>
                    <?= $currentUserInfo['username'] ?>
                </span>
                <?php endif; ?>
                <a class="btn btn-danger" href="logout.php">Odhlásit se</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
