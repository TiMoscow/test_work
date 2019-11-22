<?php
session_start();
// Вывод сообщений ошибки/обновление БД
if (isset($_SESSION['message_good']) or isset($_SESSION['message_no_good'])){
if (isset($_SESSION['message_good'])){
echo "<script>alert(\"".$_SESSION['message_good']."\");</script>";
$_SESSION['message_good'] = null;
}
elseif (isset($_SESSION['message_no_good'])){
echo "<script>alert(\"".$_SESSION['message_no_good']."\");</script>";
$_SESSION['message_no_good'] = null;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test work</title>
    <link rel="stylesheet" type="text/css" href="stile.css">
</head>
<body>
<br><br><br><br>
Закрытый файл(для примера работы, он открыт) создает "Файл 2" с API: <a href="tp.php">Фаил 1</a><br>
Файл созданный файлом "Файл 1" : <a href="file.php">Фаил 2</a><br>
Закрытый файл "Файл 3" (.htaccess) : <a href="closed.php">Фаил 3</a><br>
Перенаправление (редирект) на главную страницу "Файл 4" (.htaccess) : <a href="closed2.php">Фаил 4</a><br><br><br><br>
Удалить файл "Файл 2" с API : <a href="delite.php">Фаил 4</a><br><br><br>

<form id="test_php" action="new_test_file.php" method="POST">

Создаем новый с СОДОМ из ПОЛЯ тестовый фаил "test.php" <input type="submit" value="создаем &quot;test.php&quot;" /><br>
Создаем новый ПУСТОЙ тестовый фаил "test.php" <a href="new_test_file.php">создаем "test.php"</a><br>
    <textarea class="form-code-test"  placeholder="тут текст кода"  name="text_code" name="comment" required=""></textarea>

<!--    <input  class="form-code-test"  placeholder="тут текст кода"  name="text_code" type="text" size ="5" required="">-->
</form>
Просто открыть посмотреть "test.php" <a href="test.php">открываем "test.php"</a><br>
Просто тестовый файл для проверки разных кодов : <a href="delite_new_test_file.php">Фаил 4</a><br>
</body>
</html>




