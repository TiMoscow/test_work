<?php
namespace FileOperations;

class DeleteSafeFile
{
    private static $count = 0;

    /**
     * Get the url of the file,
     * Checking for directory/file existence,
     * Create a directory/file if it is not present,
     * Modify the file name ($ prefix) if any.
     *
     * @param string $filename
     * @return string
     */
    public static function safeFile($filename) // Проверка, создание директории/файла.
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
     * We accept the path ($dir) to the directory.
     * Accept the File Name ($file).
     * Accept the content ($text) to insert into the file.
     * Checking for the existence of a directory. If it does not exist, we create a default directory (temp).
     * Checking the existence of content. If it does not exist, we create default content (text_stub).
     * We're checking if a name exists. If it does not exist, we create a new default name (without_name_file).
     * We're sending the method (safeFile).
     * We accept the results from the method and, in case of good luck, write the file to the directory with the N-th content.
     *
     * @param string $dir
     * @param string $file
     * @param string $text
     * @return string
     */
    public static function urlSafeFile($dir, $file, $text) // Прием свойств на проверку и создание файла.
    {
        $dir    ??= 'temp'; // php ^7.4
        //$dir    = $dir ?? 'temp'; // php ^7.0
        $file = isset($file) && $file !== ''  ? $file : 'without_name_file'; // 0, '', NULL -> true
        $text   ??= 'text_stub'; // php ^7.4
        //$text    = $text ?? 'text_stub'; // php ^7.0

        if (file_put_contents(self::safeFile( $dir . "/" . $file. ".php"), $text)) {
            $arr = 'Файл \"' . $dir ."/". self::$count . '\" был создан \n';
            return $arr;
        } else {
            $arr = 'Не удалось создать файл  \"' . $dir ."/". self::$count . '\" \n';
            $arr .= 'Проверьте Ваши права на редактирование данной папки \"' . $dir . '\" \n';
            return $arr;

        }

    }

}
