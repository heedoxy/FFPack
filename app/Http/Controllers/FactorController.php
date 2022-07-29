<?php

namespace App\Http\Controllers;

use App\Helpers\PDF;
use App\Models\Factor;
use App\Models\FactorDetail;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FactorController extends Controller
{
    public function index()
    {
        $access = Auth::user()->access;
        if (in_array($access, [0, 1])) {
            $factors = DB::table('factors')
                ->select('*', 'factors.id as id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->get();
        } else {
            $user = Auth::id();
            $factors = DB::table('factors')
                ->select('*', 'factors.id as id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->where('factors.user', '=', $user)
                ->get();
        }
        return view('factor-list', ['factors' => $factors]);
    }

    public function add($id = null)
    {

        $factor = null;
        $user = Auth::id();

        if ($id) {

            $details = DB::table('factor_detail')
                ->select('*', 'factor_detail.id as id', 'factor_detail.price as price')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->where('factor', '=', $id)
                ->get();

            $factor = Factor::find($id);

        } else {
            $details = DB::table('factor_detail')
                ->select('*', 'factor_detail.id as id', 'factor_detail.price as price')
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

        $factor = $request->factor;

        $detail = new FactorDetail();
        $detail->user = Auth::id();
        $detail->factor = $factor;
        $detail->product = $request->product;
        $detail->price = $request->price;
        $detail->number = $request->number;
        $detail->status = 0;
        $detail->save();

        if ($factor)
            return redirect("/factor/show/$factor")->withErrors(['success' => 'با موفقیت ثبت شد .']);
        else
            return redirect('/factor/show')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'id' => 'required',
            'total' => 'required',
            'comment' => 'required',
        ]);

        $factor = Factor::find($id);
        $factor->price = $request->total;
        $factor->comment = $request->comment;
        $factor->save();
        return redirect('/factor/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function remove($id)
    {

    }

    public function list_detail()
    {
        $user = Auth::id();
        $access = Auth::user()->access;

        if ($access == 2)
            $details = DB::table('factor_detail')
                ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'factors.price as code')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->where('factor_detail.user', '=', $user)
                ->where('factor_detail.status', '!=', 0)
                ->get();
        else
            $details = DB::table('factor_detail')
                ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'products.name as pname', 'factors.id as fid')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->where('factor_detail.status', '!=', 0)
                ->get();


        return view('details', [
            'details' => $details
        ]);
    }

    public function remove_detail($id)
    {
        $detail = FactorDetail::findOrFail($id);
        $factor = $detail->factor;
        $detail->delete();
        if ($factor)
            return redirect("/factor/show/$factor")->withErrors(['danger' => 'با موفقیت حذف شد .']);
        else
            return redirect('/factor/show')->withErrors(['danger' => 'با موفقیت حذف شد .']);
    }

    public function today()
    {
        return Factor::whereDate('created_at', Carbon::today())->get()->sum('price');
    }

    public function week()
    {
        return Factor::whereDate('created_at', '>=', Carbon::today()->subWeek())->get()->sum('price');
    }

    public function month()
    {
        return Factor::whereDate('created_at', '>=', Carbon::today()->subMonth())->get()->sum('price');
    }

    public function factor_counter()
    {
        $user = Auth::id();
        $access = Auth::user()->access;
        if ($access == 3) return Factor::all()->where('user', $user)->count();
        else return Factor::all()->count();
    }

    public function invoice($id)
    {
        $factor = DB::table('factors')
            ->join('users', 'factors.user', '=', 'users.id')
            ->where('factors.id', '=', $id)
            ->first();
        $details = DB::table('factor_detail')
            ->select('*', 'factor_detail.id as id', 'factor_detail.price as price')
            ->join('products', 'factor_detail.product', '=', 'products.id')
            ->where('factor_detail.factor', '=', $id)
            ->get();
        return view('invoice', [
            'factor' => $factor,
            'details' => $details
        ]);
    }

    public function pdf($id)
    {
        $factor = DB::table('factors')
            ->join('users', 'factors.user', '=', 'users.id')
            ->where('factors.id', '=', $id)
            ->first();
        $details = DB::table('factor_detail')
            ->select('*', 'factor_detail.id as id', 'factor_detail.price as price')
            ->join('products', 'factor_detail.product', '=', 'products.id')
            ->where('factor_detail.factor', '=', $id)
            ->get();

        $data = [
            'factor' => $factor,
            'details' => $details
        ];

        $pdf = PDF::loadView('pdf', $data);
        return $pdf->download('invoice.pdf');

//        return view('pdf', $data);
    }

}
