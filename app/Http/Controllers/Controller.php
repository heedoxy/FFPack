<?php

namespace App\Http\Controllers;

use Hekmatinasser\Verta\Verta;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function e2p($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english= range(0, 9);
        return str_replace($english, $persian, $string);
    }

    public function p2e($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $english = range(0, 9);
        return str_replace($persian, $english, $string);
    }

    public function j2m($date) {
        $date = explode('/', $date);
        $date = implode('-', $date);
        return Verta::parse("$date 00:00:00")->datetime()->format("Y-m-d H:i:s");
    }

}
