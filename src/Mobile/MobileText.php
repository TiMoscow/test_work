<?php
namespace timnamespace\Mobile;
use Detection\MobileDetect;

class MobileText
{
    public string $text_start;
    public string $text_finish = "";

    public function setText($text_start = "message")
    {
        $this->text_start = $text_start;
    }

    public function getText()
    {
        return $this->mobilText();
    }

    private function mobilText()
    {
        $detect = new MobileDetect;
        if ($detect->isMobile() or $detect->isTablet()) {
            $this->text_finish = $this->text_start;
        }
        return $this->text_finish;

    }

}
