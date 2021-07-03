<?php
namespace Time;
/**
 * Класс для измерения времени выполнения скрипта или операций
 */
class TimerScript
{
    /**
     * @var float время начала выполнения скрипта
     */
    protected static $start;
    protected static $finish;

//    public function __construct($start, $finish)
//    {
//        $this->start = $start;
//        $this->finish = $finish;
//    }
    /**
     * Начало выполнения
     */
    public static function setStart()
    {
        self::$start = microtime(true);
    }

    /**
     * Подсчет разницы между текущей меткой времени и меткой self::$start
     */
    public static function setFinish()
    {
        self::$finish = microtime(true) - self::$start;
    }

    /**
     * Вывод результата
     * @return float
     */
    public static function getFinish()
    {
        return self::$finish;
    }
}
