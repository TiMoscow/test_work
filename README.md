# Тестовая площадка

Проект разработан как тестовая площадка по тестированию кода. 
Проект приспособлен для частного использования и в настоящий момент не приспособлен для онлайн формата в открытом доступе.
Конвертации изображения.


### Преимущества 
* Создание тестового кода
* Конвертация изображения в формат *.webp 
* Создание новой страницы с интегрированным API

### Параметры конвертора изображения
/src/FileOperations/CreateImgWebp.php

| Класс / методы        |   Тип  | Описание
| --------------------- | ------ | ------------------------------------------------------
| CreateImgWebp         | Класс  | Класс конвертора
| receiveBrowserName    | Метод  | Проверка на поддержку браузерами формата *.webp
| getUrlImg             | Метод  | Метод преобразования изображений

Пример:
```php
 CreateImgWebp::getUrlImg('/img/logo.png');
```

### Параметры работы с файлами
/src/FileOperations/DeleteSafeFile.php

| Класс / методы        |   Тип  | Описание
| --------------------- | ------ | ------------------------------------------------------
| DeleteSafeFile        | Класс  | Класс по работе с файлами.
| safeFile              | Метод  | Проверка файлов/директорий, создание файлов/директорий.
| deliteFile            | Метод  | Проверка файлов, удаление файлов.
| urlSafeFile           | Метод  | Прием свойств, обработка, взаимодействие с методами safeFile и fileExtension.
| fileExtension         | Метод  | Прием свойств, определение формата кода, формирование финального кода

### Таймен для подсчета времени работы скрипта
src/Time/TimerScript.php

| Класс / методы        |   Тип  | Описание
| --------------------- | ------ | ------------------------------------------------------
| TimerScript           | Класс  | Класс таймера сриптов.
| start                 | Метод  | Начпло таймера
| finish                | Метод  | Конец таймера / Подсчет
| getFinish             | Метод  | Вывод результатов

Пример:
```php
TimerScript::start(); //Начало таймера
echo 'Хеш: ' . password_hash("пароль", PASSWORD_DEFAULT,["cost" => 11]); // любой скрип
TimerScript::finish(); // Конец таймера

echo "<br>".TimerScript::getFinish().' сек.'; // вывод результата таймера
```

### Сообщения для мобильных устройств
src/Mobile/MobileText.php

| Класс / методы        |   Тип  | Описание
| --------------------- | ------ | ------------------------------------------------------
| MobileText            | Класс  | Класс сообщений для мобильных устройств
| setText               | Метод  | Принимаем сообщение
| getText               | Метод  | Отдаем сообщение для мобильного устройства
| mobilText             | Метод  | Определение мобильного устройства, запись сообщения

Пример:
```php
$textmobil = new MobileText;
$textmobil->setText('Текст сообщения');
echo $textmobil->getText();
```


### Быстрый старт
Установите библиотеки с помощью [Node.js](https://nodejs.org/):

    npm install --production

Установите зависимости с помощью composer [composer](https://getcomposer.org/):

    composer update


### Требования к системе
* PHP:                ^7.4 (^7.0*)
* GD WebP Support:    enabled




#### PHP 7.0**  
* В файле: src/FileOperations/DeleteSafeFile.php
* Измените на это:
```php
        //$dir    ??= 'temp'; // php ^7.4
        $dir    = $dir ?? 'temp'; // php ^7.0

        //$text   ??= 'text_stub'; // php ^7.4
        $text    = $text ?? 'text_stub'; // php ^7.0
        
        //$file_extension ??= 'php'; // php ^7.4
        $file_extension    = $file_extension ?? 'php'; // php ^7.0
```


### Старт проекта: 
30.04.2019
