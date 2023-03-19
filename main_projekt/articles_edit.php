<?php

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    require_once 'classes/Database.php';
    $db = new Database();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];
        if (empty($_POST['author_id'])) {
            $errors[] = 'Vyberte autora';
        }

        if (empty($_POST['category_id'])) {
            $errors[] = 'Vyberte kategorii';
        }

        if (empty($_POST['title'])) {
            $errors[] = 'Titulek nesmí být prázdný';
        }

        if (empty($_POST['introduction'])) {
            $errors[] = 'Úvod nesmí být prázdný';
        }

        if (empty($_POST['content'])) {
            $errors[] = 'Obsah nesmí být prázdný';
        }



        if (empty($errors)) {
            $is_published = 0;
            if (!empty($_POST['is_published']) && $_POST['is_published'] == '1') {
                $is_published = 1;
            }

            $sql = 'Update articles set author_id = :author_id, category_id = :category_id, title = :title,
                    introduction = :introduction, content = :content, is_published = :is_published
                    where id = :id';
            $stmt = $db->conn->prepare($sql);
            $stmt->execute([
                ':author_id' => $_POST['author_id'],
                ':category_id' => $_POST['category_id'],
                ':title' => $_POST['title'],
                ':introduction' => $_POST['introduction'],
                ':content' => $_POST['content'],
                ':is_published' => $is_published,
                ':id' => $_GET['id'],
            ]);

            header('Location: articles_list.php');
            die();
        }
    }


    $sql = 'select * from authors';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute();
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'select * from categories';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);


    $sql = 'select * from articles where id = :id';
    $stmt = $db->conn->prepare($sql);
    $stmt->execute([
        ':id' => $_GET['id'],
    ]);
    $article = $stmt->fetch(PDO::FETCH_ASSOC);
}
else {
    header('Location: articles_list.php');
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
    <title>Úprava článku</title>

    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./styles/articles_add.css">
    <script src="./tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: '#article_content',
            resize: false,
            width: 1000,
            height: 500,
            menubar: false,
            language: "cs",
            setup: function (editor) {
                editor.on('change', function () {
                    tinymce.triggerSave();
                });
            },
            init_instance_callback: function (editor) {
                /*při inicializaci tinymce se zavolá tato funkce*/
                const textarea = document.getElementById("article_content");
                textarea.style.display = "block";
                textarea.style.opacity = "0";
                textarea.style.width = "0";
                textarea.style.height = "0";
                textarea.style.minHeight = "0";
            }
        });

    </script>
</head>
<body>

<?php include_once 'reusable_components/navbar.php'; ?>

<div class="container-fluid row justify-content-center">
    <div class="col-11">
        <h1 class="mb-4">Upravit článek</h1>
        <?php if (!empty($errors)): ?>
            <ul>
                <?php foreach($errors as $error): ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <div>
            <form method="post" id="submitForm">
                <div class="mb-3">
                    <label>
                        Autor:
                        <select name="author_id" class="form-select" required>
                            <option value="" selected>Vyberte autora</option>
                            <?php foreach ($authors as $author): ?>
                                <option value="<?= $author['id'] ?>"
                                <?php
                                    if ($author['id'] == $article['author_id']) {
                                        echo 'selected';
                                    }
                                ?>
                                >
                                    <?= $author['name'].' '.$author['surname'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Kategorie:
                        <select name="category_id" class="form-select" required>
                            <option value="" selected>Vyberte kategorii</option>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"
                                <?php
                                    if ($category['id'] == $article['category_id']) {
                                        echo 'selected';
                                    }
                                ?>
                                >
                                    <?= $category['category_name'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="is_published" value="1"
                        <?php
                            if ($article['is_published'] == '1') {
                                echo 'checked';
                            }
                        ?>
                        >
                        Zveřejněný
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Titulek:
                        <textarea name="title" class="form-control" cols="60" rows="10" required><?= $article['title'] ?></textarea>
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Úvod:
                        <textarea name="introduction" class="form-control" cols="60" rows="20" required><?= $article['introduction'] ?></textarea>
                    </label>
                </div>
                <div class="mb-3">
                    <label>
                        Obsah:
                        <textarea name="content" id="article_content" class="form-control" required><?= $article['content'] ?></textarea>
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Uložit</button>
            </form>
        </div>
    </div>
</div>




<script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>