<?php

namespace App\Http\Controllers;

use App\Models\Factor;
use App\Models\FactorDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FactorController extends Controller
{
    public function index()
    {
        $factors = Factor::all();
        return view('factor-list', ['factors' => $factors]);
    }

    public function add($id = null)
    {

        $user = Auth::id();

        if ($id) {
            $details = DB::table('factor_detail')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->where('factor', '=', $id)
                ->get();
        } else {
            $details = DB::table('factor_detail')
                ->select('*','factor_detail.id as id')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->where('factor_detail.user', '=', $user)
                ->where('factor_detail.status', '=', 0)
                ->get();
        }

        $products = Product::all();
        $users = User::all()->where('access', '=', 3);

        return view('factor', [
            'id' => $id,
            'details' => $details,
            'products' => $products,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {

    }

    public function store_detail(Request $request)
    {
        $this->validate($request, [
            'factor' => 'required',
            'product' => 'required',
            'price' => 'required',
            'number' => 'required',
        ]);

        $detali = new FactorDetail();
        $detali->user = Auth::id();
        $detali->factor = $request->factor;
        $detali->product = $request->product;
        $detali->price = $request->price;
        $detali->number = $request->number;
        $detali->status = 0;
        $detali->save();
        return redirect('/factor/show')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function update(Request $request)
    {

    }

    public function remove($id)
    {

    }

    public function remove_detail($id)
    {
        $detail = FactorDetail::findOrFail($id);
        $detail->delete();
        return redirect('/factor/show')->withErrors(['danger' => 'با موفقیت حذف شد .']);
    }

}
