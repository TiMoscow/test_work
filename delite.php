<?php
session_start();

$filename = 'file.php';
if (file_exists($filename)){
    unlink('file.php');

    $_SESSION['message_good'] .= 'Файл удален \n';
    header("Location: ".$_SERVER["HTTP_REFERER"]);
    exit;
}
else {
    $_SESSION['message_no_good'] .= 'Файла на удаление нет! \n';
    header("Location: ".$_SERVER["HTTP_REFERER"]);
    exit;
}