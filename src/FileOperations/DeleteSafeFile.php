<?php
namespace timnamespace\FileOperations;

class DeleteSafeFile
{
    private static $count = 0;

    /**
     * Getting Path ($dir_f)
     * Get an array ($file) of names to delete.
     * By the method of search, we check the existence.
     * Delete if the file exists.
     *
     * @param string $dir_f
     * @param array $file
     * @return array
     */
    public static function deliteFile($dir_f, $file) // Удаление файла/ов.
    {

        $arr = [];
        foreach ($file as $key => $value) {
            $file_name = "$dir_f/" . $value;

            if (file_exists($file_name)) {
                unlink($file_name);

                $arr[] = 'Файл \"' . $file_name . '\" удален \n';
            } else {
                $arr[] = 'Файла \"' . $file_name . '\" на удаление нет! \n';
            }

        }
        return $arr;
    }

    /**
     * Get the url of the file,
     * Checking for directory/file existence,
     * Create a directory/file if it is not present,
     * Modify the file name ($ prefix) if any.
     *
     * @param string $filename
     * @return string
     */
    private static function safeFile($filename) // Проверка, создание директории/файла.
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

    private static function timerCode($arr_code, $text_code)
    {
        if ($arr_code["timerScript"] == "Y") {
            $TimerScriptStart = '<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . "/vendor/autoload.php");
use timnamespace\Time\TimerScript;
TimerScript::setStart(); ?>' . PHP_EOL;
            $TimerScriptFinish = PHP_EOL .'<?php echo "<br>".TimerScript::setGetFinish(); ?>';
            return $TimerScriptStart . $text_code . $TimerScriptFinish;
        } else {
            return $text_code;
        }
    }
    /**
     *Getting the code ($arr_code["text_code"])
     *Getting Code Type ($arr_code["file_extension"])
     *Find a match code in the array to insert
     *We form the final code
     *
     * @param $arr_code
     * @return string
     */
    private static function fileExtension($arr_code) // Перебор расширения файлов  из массива
    {

        $arr_extension_start = [
            'php' => '<?php '.PHP_EOL,
            'html' => '<!doctype html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Document</title>
            </head>
            <body>'.PHP_EOL,
            'js' => '<script>'.PHP_EOL
        ];
        $arr_extension_end = [
            'php' => PHP_EOL.'?>',
            'html' => PHP_EOL.'</body>
</html>',
            'js' => PHP_EOL.'</script>'
        ];

        foreach ($arr_extension_start as $key => $value) {
            if ($key == $arr_code["file_extension"]) {
                $extension_start = $value;
                break;
            }
        }
        foreach ($arr_extension_end as $key => $value) {
            if ($key == $arr_code["file_extension"]) {
                $extension_end = $value;
                break;
            }
        }
        return self::timerCode($arr_code,$extension_start.$arr_code["text_code"].$extension_end);
//        return $extension_start.$arr_code["text_code"].$extension_end;
    }


    /**
     *     /**
     * We accept the path ($arr_code["dir_f"]) to the directory.
     * Accept the File Name ($arr_code["file_name"]).
     * Accept the content ($arr_code["text_code"]) to insert into the file.
     * Checking for the existence of a directory. If it does not exist, we create a default directory (temp).
     * Checking the existence of content. If it does not exist, we create default content (text_stub).
     * We're checking if a name exists. If it does not exist, we create a new default name (without_name_file).
     * We're sending the method (safeFile).
     * We accept the results from the method and, in case of good luck, write the file to the directory with the N-th content.
     *
     * @param $arr_code
     * @return string
     */
    public static function urlSafeFile($arr_code): string // Прием свойств на проверку и создание файла.
    {
        $arr_code["dir_f"]    ??= 'temp'; // php ^7.4
        //$arr_code["dir_f"]    = $arr_code["dir_f"] ?? 'temp'; // php ^7.0
        $arr_code["file_name"] = isset($arr_code["file_name"]) && $arr_code["file_name"] !== ''  ? $arr_code["file_name"] : 'without_name_file'; // 0, '', NULL -> true
        $arr_code["text_code"]   ??= 'text_stub'; // php ^7.4
        //$arr_code["text_code"]    = $arr_code["text_code"] ?? 'text_stub'; // php ^7.0
        $arr_code["file_extension"] ??= 'html'; // php ^7.4
        //$arr_code["file_extension"]    = $arr_code["file_extension"] ?? 'php'; // php ^7.0

        if (file_put_contents(self::safeFile( $arr_code["dir_f"] . "/" . $arr_code["file_name"]. ".php"), self::fileExtension($arr_code))) {
            $arr = 'Файл \"' . $arr_code["dir_f"] ."/". self::$count . '\" был создан \n';
            return $arr;
        } else {
            $arr = 'Не удалось создать файл  \"' . $arr_code["dir_f"] ."/". self::$count . '\" \n';
            $arr .= 'Проверьте Ваши права на редактирование данной папки \"' . $arr_code["dir_f"] . '\" \n';
            return $arr;

        }

    }

}
