<?php

namespace timnamespace\Time;

/**
 * Класс для измерения времени выполнения скрипта или операций
 */
class TimerScript
{

    /**
     * время начала выполнения скрипта
     * @var
     */
    protected static $start;
    protected static $finish;

    /**
     * Устанавливаем метку $start
     */
    public static function setStart()
    {
        self::$start = microtime(true);
    }


    /**
     * Подсчет разницы между текущей меткой времени и меткой $start
     * БЕЗ вывода результатов
     */
    public static function sumFinish()
    {
        $elapsed = microtime(true) - self::$start;
        if ($elapsed < 0.0001) {
            self::$finish = "Слишком быстро!! (< 0.0001 сек.)";
        } else {
            self::$finish = $elapsed . ' сек.';
        }
    }

    /**
     * Подсчет разницы между текущей меткой времени и меткой self::$start
     * С выводом результатов
     * @return string
     */
    public static function setGetFinish()
    {
        $elapsed = microtime(true) - self::$start;
        if ($elapsed < 0.0001) {
            self::$finish = "Слишком быстро! (< 0.0001 сек.)";
            return self::$finish;
        } else {
            self::$finish = $elapsed;
            return self::$finish . ' сек.';
        }
    }


    /**
     * Вывод результата
     * @return string
     */
    public static function getFinish()
    {
        return self::$finish;
    }
}
