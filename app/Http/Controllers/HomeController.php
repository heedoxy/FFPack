<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() {
        $today = (new FactorController())->today();
        $week = (new FactorController())->week();
        $month = (new FactorController())->month();
        $factor = (new FactorController())->factor_counter();
        $user = (new UserController())->user_counter();
        $producer = (new UserController())->producer_counter();
        return view('index', [
            'today' => $today,
            'week' => $week,
            'month' => $month,
            'factor' => $factor,
            'user' => $user,
            'producer' => $producer,
        ]);
    }
}
