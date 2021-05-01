<?php
namespace TiMoscow;

class Imgwebp
{
    public static function get_browser_name(){
        /********** Определяем браузер START**********/

        $t = strtolower($_SERVER['HTTP_USER_AGENT']);
        $t = " " . $t;
        if     (strpos($t, 'opera'     ) || strpos($t, 'opr/')     ) return 'Opera'            ;
        elseif (strpos($t, 'edge'      )                           ) return 'Edge'             ;
        elseif (strpos($t, 'chrome'    )                           ) return 'Chrome'           ;
        elseif (strpos($t, 'safari'    )                           ) return 'Safari'           ;
        elseif (strpos($t, 'firefox'   )                           ) return 'Firefox'          ;
        elseif (strpos($t, 'msie'      ) || strpos($t, 'trident/7')) return 'Internet Explorer';
        return 'Unkown';
        /********** Определяем браузер END**********/
    }

    private static $img_webp_inf; // свойство - вывод сообщений

    public static function function_img_webp($img_orig)
    {
        $pattern = '/\S+(?:jpg|jpeg|png|JPG|JPEG|PNG)$/';
        if (preg_match($pattern, $img_orig)){

            //$img_orig = '/img/mirrodium_resize_cache/iblock/00a/650_900_2/00aec3adccdc2b6d475f3158f78d1249.jpg'; // оригинальный файл
            $pathinfo = pathinfo($img_orig); // оригинальный файл - путь в массив
            $path_name = $pathinfo['dirname']; // путь
            $path_basename = $pathinfo['basename']; // имя файла с расширением
            $path_extension = $pathinfo['extension']; // расширение
            $path_filename = $pathinfo['filename']; //имя файла БЕЗ расширения
            $fileimg = $_SERVER['DOCUMENT_ROOT'] . '/img/webp' . $path_name . '/' . $path_filename . '.webp'; // соединяем в единый адрес с *.webp
            $all_path = $_SERVER['DOCUMENT_ROOT'] . '/img/webp' . $path_name; // Весь путь до файла на хостинге

            if (file_exists($fileimg)) { // проверяем есть ли файл webp

                if (self::get_browser_name() == 'Safari'){
                    $img_webp = $img_orig;
                }else{
                    $img_webp = '/img/webp' . $path_name . '/' . $path_filename . '.webp';
                }
                self::$img_webp_inf .=  'Файл есть - отдаем<br>'.self::get_browser_name();
            } elseif (!file_exists($all_path)) {
                self::$img_webp_inf .=  'нет директории файла<br>';
                if (!mkdir($_SERVER['DOCUMENT_ROOT'] . '/img/webp' . $path_name, 0777, true) && !is_dir($_SERVER['DOCUMENT_ROOT'] . '/img/webp/' . $path_name)) {
                    self::$img_webp_inf .=  'ошибка создания директории <br>';
                } else {
                    // self::$img_webp_inf .=   'создали директорию для файла <br>';
                    $image = imagecreatefromstring(file_get_contents($_SERVER['DOCUMENT_ROOT'] . $img_orig));
                    ob_start();
                    imagejpeg($image, NULL, 100);
                    $cont = ob_get_contents();
                    ob_end_clean();
                    imagedestroy($image);
                    $content = imagecreatefromstring($cont);
                    $output = $_SERVER['DOCUMENT_ROOT'] . '/img/webp' . $path_name . '/' . $path_filename . '.webp';
                    imagewebp($content, $output,80);
                    imagedestroy($content);
                    if (isset($output)) {
                    // self::$img_webp_inf .=   'создали новый файл webp <br>';
                    // self::$img_webp_inf .=   $all_path.' Весь путь до файла на хостинге <br>';
                    // self::$img_webp_inf .=   $fileimg.' соединяем в единый адрес с *.webp <br>';
                    // self::$img_webp_inf .=   $output.'  куда создали файл webp / что получили после конвертации <br>';
                    }
                    if (self::get_browser_name() == 'Safari'){
                        $img_webp = $img_orig;
                    }else{
                        $img_webp = '/img/webp' . $path_name . '/' . $path_filename . '.webp';
                    }


                }
            } else {
                // self::$img_webp_inf .=   'нет файла, НО есть директория --> создаем файл<br>';
                // self::$img_webp_inf .=   $img_orig. ' оригинальный файл<br>';

                $image = imagecreatefromstring(file_get_contents($_SERVER['DOCUMENT_ROOT'] . $img_orig));
                ob_start();
                imagejpeg($image, NULL, 100);
                $cont = ob_get_contents();
                ob_end_clean();
                imagedestroy($image);
                $content = imagecreatefromstring($cont);
                $output = $_SERVER['DOCUMENT_ROOT'] . '/img/webp' . $path_name . '/' . $path_filename . '.webp';
                imagewebp($content, $output,80);
                imagedestroy($content);
                if (isset($output)) {
                // echo 'создали новый файл webp <br>';
                // echo $output.' куда создали файл webp / что получили после конверта <br>';
                }
                if (self::get_browser_name() == 'Safari'){
                    $img_webp = $img_orig;
                }else{
                    $img_webp = '/img/webp' . $path_name . '/' . $path_filename . '.webp';
                }
            }

            return $img_webp;
        }
        return "передан иной параметр";

    }
    public static function messages_and_errors_img_webp(){
        return self::$img_webp_inf;// выводить сообщения

    }
}
