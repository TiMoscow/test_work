<?php
session_start();

$filename = 'test.php';
if (file_exists($filename)){
    unlink('test.php');

    $_SESSION['message_good'] .= 'Файл удален test.php \n';
    header("Location: ".$_SERVER["HTTP_REFERER"]);
    exit;
}
else {
    $_SESSION['message_no_good'] .= 'Файла test.php на удаление нет! \n';
    header("Location: ".$_SERVER["HTTP_REFERER"]);
    exit;
}