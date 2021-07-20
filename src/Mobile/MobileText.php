<?php
namespace timnamespace\Mobile;
use Detection\MobileDetect;

class MobileText
{
    public static string $text_start;
    public static string $text_finish = "";

    public static function setGetText($text_start = "message"): string
    {
        self::$text_start = $text_start;
        return self::mobilText();
    }

    private static function mobilText(): string
    {
        $detect = new MobileDetect;
        if ($detect->isMobile() or $detect->isTablet()) {
            self::$text_finish = self::$text_start;
        }
        return self::$text_finish;

    }

}
