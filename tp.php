<?php
session_start();

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/src/FileOperations/DeleteSafeFile.php')) {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/src/FileOperations/DeleteSafeFile.php');
}

use FileOperations\DeleteSafeFile;

if (isset($_POST['submit_api_create']) and
    isset($_POST['api_file_name']) or
    isset($_POST['submit_code_create_php']) or
    isset($_POST['submit_code_create_html']) or
    isset($_POST['submit_code_create_js']) or
    isset($_POST['text_code'])) { // создаем файл с api


    if (isset($_POST['submit_api_create'])) {
        $dir_f = "code_api";
        $file_name = htmlspecialchars($_POST['api_file_name']);
        $text_api = file_get_contents('include/test_api.php', true); // берем код из файла
        $arr = DeleteSafeFile::urlSafeFile($dir_f, $file_name, $text_api);
        $_SESSION['message_good'] = $arr;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;

    } elseif (
        isset($_POST['submit_code_create_php']) or
        isset($_POST['submit_code_create_html']) or
        isset($_POST['submit_code_create_js'])
    ) {
        $dir_f = "code";
        $file_name = htmlspecialchars($_POST['name_code']);
        if ($_POST['submit_code_create_php']) {
            $file_extension = 'php';
        } elseif ($_POST['submit_code_create_html']) {
            $file_extension = 'html';
        } elseif ($_POST['submit_code_create_js']) {
            $file_extension = 'js';
        } else {
            header("Location: " . $_SERVER["HTTP_REFERER"]);
            exit;
        }
        $text_code = $_POST['text_code'];
        $arr = DeleteSafeFile::urlSafeFile($dir_f, $file_name, $text_code, $file_extension);
        $_SESSION['message_good'] = $arr;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit;
    }
} elseif (isset($_POST['submit_api_delete']) or isset($_POST['submit_code_delete']) or isset($_POST['submit_code_open']) or isset($_POST['submit_api_open']) and isset($_POST['file'])) { // Удаляем созданные файлы с api

    $file = $_POST['file'];
    if (isset($_POST['submit_api_delete']) or isset($_POST['submit_api_open'])) {
        $dir_f = "code_api";
    } elseif (isset($_POST['submit_code_delete']) or isset($_POST['submit_code_open'])) {
        $dir_f = "code";
    }
    if (isset($_POST['submit_api_open']) or isset($_POST['submit_code_open'])) {
        header("location:" . $dir_f . "/" . $file[0]);
        exit;
    }

    $arr = DeleteSafeFile::deliteFile($dir_f, $file);

    $_SESSION['message_good'] = $arr;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
} else {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit;
}

















