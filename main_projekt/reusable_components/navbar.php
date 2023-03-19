<nav class="navbar navbar-expand-lg bg-primary mb-4" data-bs-theme="dark">
    <div class="container-fluid">
        <div class="navbar-nav">
            <a class="nav-link
            <?php
                $base = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                if ($base == 'index' || $base == 'articles_detail') {
                    echo "active";
                }
            ?>" href="index.php">Zprávy</a>
            <a class="nav-link
            <?php
                $base = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                if ($base == 'categories_list' || $base == 'categories_detail' || $base == 'categories_edit' || $base == 'categories_add') {
                    echo "active";
                }
            ?>" href="categories_list.php">Kategorie</a>
            <a class="nav-link
            <?php
                $base = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                if ($base == 'authors_list' || $base == 'authors_detail' || $base == 'authors_edit' || $base == 'authors_add') {
                    echo "active";
                }
            ?>" href="authors_list.php">Autoři</a>
            <a class="nav-link
            <?php
                $base = basename($_SERVER["SCRIPT_FILENAME"], '.php');
                if ($base == 'articles_list' || $base == 'articles_edit' || $base == 'articles_add') {
                    echo "active";
                }
            ?>" href="articles_list.php">Administrace článků</a>
        </div>
    </div>
</nav>
