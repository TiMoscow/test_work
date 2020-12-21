<?php
session_start();
// Вывод сообщений ошибки/обновление/удачно
if (isset($_SESSION['message_good']) or isset($_SESSION['message_no_good'])) {
    if (isset($_SESSION['message_good'])) {

        if (is_array($_SESSION['message_good'])) {
            echo "<script>alert(\"";
            foreach ($_SESSION['message_good'] as $key => $value) {
                echo $value;
            }
            echo "OK\")</script>";
        } elseif (!is_array($_SESSION['message_good'])) {
            echo "<script>alert(\"" . $_SESSION['message_good'] . " OK\")</script>";
        }

        $_SESSION['message_good'] = null;
    } elseif (isset($_SESSION['message_no_good'])) {
        echo "<script>alert(\"" . $_SESSION['message_no_good'] . " NO OK\")</script>";
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
<form action="tp.php" method="POST">
    Имя файла
    <input class=""   type="text" size="40" placeholder="Имя файла"  name="file_name" required="">
<!--Закрытый файл(для примера работы, он открыт) создает "Файл 2" с API: <a href="tp.php">Фаил 1</a><br>-->
    Создаем новый API с именем файла из ПОЛЯ "test.php. В папке "API". <input type="submit" value="создаем API" /><br>
</form>

<form action="delite.php" method="POST">
    Имя файла на удаление<br>
    <select size="10" multiple required name="delite_file[]">
        <option disabled>выберете файл</option>
        <?
        if ($handle = opendir('api')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {

                    echo "<option value=" . $file . ">" . $file . "</option>";
                }
            }
            closedir($handle);
        }
        ?>
    </select>
    <br />
    Удалить файл/ы с папки "API" : <input type="submit" value="Удалить файл созданны в 'API'" /><br>
</form>
<br><br><br>

<!--Файл созданный файлом "Файл 1" : <a href="api/file.php">Фаил 2</a><br>-->
<!--Закрытый файл "Файл 3" (.htaccess) : <a href="closed.php">Фаил 3</a><br>-->
Перенаправление (редирект) на главную страницу "Файл 4" (.htaccess) : <a href="closed2.php">Фаил 4</a><br><br><br><br>

<form id="test_php" action="new_test_file.php" method="POST">

Создаем новый с КОДОМ из ПОЛЯ тестовый фаил "test.php (&lt;?php уже есть)" <input type="submit" value="создаем &quot;test.php&quot;" /><br>
Создаем новый ПУСТОЙ тестовый фаил "test.php" <a href="new_test_file.php">создаем "test.php"</a><br>
    <textarea class="form-code-test"  placeholder="тут текст кода"  name="text_code" name="comment" required=""></textarea>

<!--    <input  class="form-code-test"  placeholder="тут текст кода"  name="text_code" type="text" size ="5" required="">-->
</form>
Просто открыть посмотреть "test.php" <a href="test.php">открываем "test.php"</a><br>
УДАЛИТЬ "test.php": <a href="delite_new_test_file.php">УДАЛИТЬ</a><br>
</body>
</html>




