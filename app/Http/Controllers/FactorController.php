<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\FactorDetail;
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
        if ($id) $details = FactorDetail::where('factor', '=', $id);
        else $details = FactorDetail::where('status', '=', '0');
        return view('factor', ['id' => $id, 'details' => $details]);
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
