<?php
session_start();
$text_code = $_POST['text_code'];
// строка, которую будем записывать
$text = <<< HTML
<a href="/">Назад</a><br>
<?php

$text_code
HTML;
//$text .= $text_code;
// открываем файл, если файл не существует,
//делается попытка создать его
$fp = fopen("test.php", "w");
// записываем в файл текст
fwrite($fp, $text);
// закрываем
fclose($fp);

$_SESSION['message_no_good'] .= 'создаем \"test.php\"\n'.$text_code;
header("Location: ".$_SERVER["HTTP_REFERER"]);
exit;
