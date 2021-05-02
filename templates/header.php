<?php
if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/src/FileOperations/CreateImgWebp.php')) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/FileOperations/CreateImgWebp.php');
}
use FileOperations\CreateImgWebp;

session_start();
// Вывод сообщений ошибки/обновление/удачно
if (isset($_SESSION['message_good'])) {
        if (is_array($_SESSION['message_good'])) {
            echo "<script>alert(\"";
            foreach ($_SESSION['message_good'] as $key => $value) {
                echo $value;
            }
            echo "OK\")</script>";
        } elseif (!is_array($_SESSION['message_good'])) {
            echo "<script>alert(\"" . $_SESSION['message_good'] . " OK\")</script>";
        }
        $_SESSION['message_good'] = null;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Test work</title>
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="sass/custom_bootstrap.css" rel="stylesheet" crossorigin="anonymous">
    <script defer src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="node_modules/bootstrap-icons/font/bootstrap-icons.css">
</head>
<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?= CreateImgWebp::getUrlImg('/img/logo.png'); ?>" alt="" width="30" height="24">
        </a>
        <button type="button" class="btn btn-outline-custom-theme-custom-orange">
            <i class="bi bi-door-open"></i>
            Войти
        </button>
    </div>
</nav>


