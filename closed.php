<?php
session_start();
echo "Этот файл недоступен для просмотра";

$a[0] = 1;
$a[1] = 3;
$a[2] = 5;
$result = count($a);
// $result == 3

$b[0] = 7;
$b[5] = 9;
$b[10] = 11;
$result = count($b);
// $result == 3;

$result1 = count(null);
// $result == 0;

$result2 = count(false);
// $result == 1;

$_SESSION['message_no_good'] .= 'в разработке (пустышка) \n';
header("Location: ".$_SERVER["HTTP_REFERER"]);
