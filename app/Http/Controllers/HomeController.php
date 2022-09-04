<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {

        $factor = new FactorController();

        $today = $factor->today();
        $week = $factor->week();
        $month = $factor->month();

        $status_3 = $factor->detail_status_counter(3);
        $status_6 = $factor->detail_status_counter(6);
        $status_7 = $factor->detail_status_counter(7);
        $status_8 = $factor->detail_status_counter(8);

        return view('index', [
            'today' => $today,
            'week' => $week,
            'month' => $month,
            'status_3' => $status_3,
            'status_6' => $status_6,
            'status_7' => $status_7,
            'status_8' => $status_8,
        ]);
    }
}
