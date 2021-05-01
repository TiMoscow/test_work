<?php
if (file_exists(__DIR__ . '/user_library/safe_file.php')) {
    require_once(__DIR__ . '/user_library/safe_file.php');
}

use TiMoscow\operations_file;


if (isset($_POST['submit_api_create']) and isset($_POST['api_file_name']) or isset($_POST['submit_code_create']) and isset($_POST['text_code'])) { // создаем файл с api


    if (isset($_POST['submit_api_create'])) {
        $dir_f = "code_api";
        $file_name = htmlspecialchars($_POST['api_file_name']);
        $text_api = file_get_contents('include/test_api.php', true); // берем код из файла
        if (operations_file::checking_the_file($dir_f, $file_name, $text_api)) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }

    } elseif (isset($_POST['submit_code_create'])) {
        $dir_f = "code";
        $file_name = htmlspecialchars($_POST['name_code']);

        $text_code = <<< HTML
        <a href="/">Назад</a><br>
        <?php

        HTML;
        $text_code .= $_POST['text_code'];

        if (operations_file::checking_the_file($dir_f, $file_name, $text_code)) {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }
    }
} elseif (isset($_POST['submit_api_delete']) or isset($_POST['submit_code_delete']) or isset($_POST['submit_code_open']) or isset($_POST['submit_api_open']) and isset($_POST['file'])) { // Удаляем созданные файлы с api

    $file = $_POST['file'];
    if (isset($_POST['submit_api_delete']) or isset($_POST['submit_api_open'])) {
        $dir_f = "code_api";
    } elseif (isset($_POST['submit_code_delete']) or isset($_POST['submit_code_open'])) {
        $dir_f = "code";
    }
    if (isset($_POST['submit_api_open']) or isset($_POST['submit_code_open'])) {
        header("location:".$dir_f."/".$file[0]);
        exit;
    }

    $arr =  operations_file::delite_file($dir_f, $file);

    $_SESSION['message_good'] = $arr;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

















