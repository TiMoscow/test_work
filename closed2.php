<?php
session_start();
echo "Этот файл недоступен для просмотра";

$_SESSION['message_no_good'] .= 'Не авторизован! \n';
header("Location: ".$_SERVER["HTTP_REFERER"]);
exit;
