<?php
session_start();

//$filename = 'file.php';
$delite_file = $_POST['delite_file'];
//$filename = $_POST['delite_file'];

$arr = array();

foreach ($delite_file as $key => $value) {
    $file_name = "api/".$value; //добовляем уровень вложения файла


    if (file_exists($file_name)) {
        unlink($file_name);

        $arr[] = 'Файл ' . $file_name . ' удален \n';
    } else {
        $arr[] = 'Файла ' . $file_name . ' на удаление нет! \n';
    }
}
$_SESSION['message_good'] = $arr;
header("Location: " . $_SERVER["HTTP_REFERER"]);
exit;

