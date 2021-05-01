<?php
namespace TiMoscow;

session_start();

class operations_file
{
    private static $count = 0;
    public static function safe_file_search($filename) // Проверка, создание директории/файла.
    {

        $dir = dirname($filename);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        $info = pathinfo($filename);
        $name = $dir . '/' . $info['filename'];
        $prefix = '';
        $ext = (empty($info['extension'])) ? '' : '.' . $info['extension'];

        if (is_file($name . $ext)) {
            $i = 1;
            $prefix = '__' . $i;
            while (is_file($name . $prefix . $ext)) {
                $prefix = '__' . ++$i;
            }
        }
        self::$count = $info['filename']. $prefix . $ext;
        return $name . $prefix . $ext;
    }
    public static function delite_file($dir_f, $file) // Удаление файла/ов.
    {

        $arr = [];
        foreach ($file as $key => $value) {
            $file_name = "$dir_f/" . $value;

            if (file_exists($file_name)) {
                unlink($file_name);

                $arr[] = 'Файл ' . $file_name . ' удален \n';
            } else {
                $arr[] = 'Файла ' . $file_name . ' на удаление нет! \n';
            }

        }
        return $arr;
    }



    public static function checking_the_file($dir,$file,$text) // Прием свойст на проверку и создание файла.
    {
        $dir     ??= 'temp';
        $file = isset($file) && $file !== ''  ? $file : 'without_name_file'; // 0, '', NULL -> true
        $text    ??= 'text_stub';

        if (file_put_contents(self::safe_file_search(__DIR__ . "/../" . $dir . "/" . $file. ".php"), $text)) {
            $_SESSION['message_good'] .= 'Файл был создан в папке \"' . $dir . ' \n';
            $_SESSION['message_good'] .= 'Имя файла  \"' . self::$count . '\" \n';
            return true;
        } else {
            return false;

        }

    }

}
