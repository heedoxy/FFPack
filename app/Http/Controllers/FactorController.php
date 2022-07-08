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
        $factors = DB::table('factors')
            ->select('*', 'factors.id as id')
            ->join('users', 'factors.user', '=', 'users.id')
            ->get();
        return view('factor-list', ['factors' => $factors]);
    }

    public function add($id = null)
    {

        $factor = null;
        $user = Auth::id();

        if ($id) {

            $details = DB::table('factor_detail')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->where('factor', '=', $id)
                ->get();

            $factor = Factor::find($id);

        } else {
            $details = DB::table('factor_detail')
                ->select('*', 'factor_detail.id as id')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->where('factor_detail.user', '=', $user)
                ->where('factor_detail.status', '=', 0)
                ->get();
        }

        $products = Product::all();
        $users = User::all()->where('access', '=', 3);

        return view('factor', [
            'id' => $id,
            'factor' => $factor,
            'details' => $details,
            'products' => $products,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'total' => 'required',
            'comment' => 'required',
        ]);

        $factor = new Factor();
        $factor->code = "FFP-" . rand(1000, 9999);
        $factor->staff = Auth::id();
        $factor->user = $request->user;
        $factor->price = $request->total;
        $factor->comment = $request->comment;
        $factor->status = 1;
        $factor->save();

        $id = $factor->id;
        $detail = FactorDetail::where('user', '=', Auth::id())
            ->where('status', '=', 0)
            ->update([
                'factor' => $id,
                'status' => 1
            ]);

        return redirect('/factor/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function store_detail(Request $request)
    {
        $this->validate($request, [
            'factor' => 'required',
            'product' => 'required',
            'price' => 'required',
            'number' => 'required',
        ]);

        $detail = new FactorDetail();
        $detail->user = Auth::id();
        $detail->factor = $request->factor;
        $detail->product = $request->product;
        $detail->price = $request->price;
        $detail->number = $request->number;
        $detail->status = 0;
        $detail->save();
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
