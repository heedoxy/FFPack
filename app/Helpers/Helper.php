<?php

namespace App\Helpers;

class Helper
{
    public function e2p($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $num = range(0, 9);
        return str_replace($num, $persian, $string);
    }
}
