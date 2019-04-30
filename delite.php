<?php
session_start();

unlink('file.php');
$_SESSION['message_no_good'] .= 'Файл удален \n';
header("Location: ".$_SERVER["HTTP_REFERER"]);
exit;