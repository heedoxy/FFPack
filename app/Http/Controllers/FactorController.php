<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use Illuminate\Http\Request;

class FactorController extends Controller
{
    public function index()
    {
        $factors = Factor::all();
        return view('factor-list', ['factors' => $factors]);
    }

    public function add($id = null)
    {
        return view('factor');
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request)
    {

    }

    public function remove($id) {

    }
}
