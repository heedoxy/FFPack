<?php

namespace App\Http\Controllers;

use App\Helpers\PDF;
use App\Models\Factor;
use App\Models\FactorDetail;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
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
        $staff = Auth::id();

        if ($id) {

            $details = DB::table('factor_detail')
                ->select(
                    '*',
                    'factor_detail.id as id',
                    'factor_detail.price as price',
                    'factor_detail.unit as unit',
                    'units.title as unit_title'
                )
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->join('units', 'factor_detail.unit', '=', 'units.id')
                ->where('factor', '=', $id)
                ->get();

            $factor = Factor::find($id);

        } else {
            $details = DB::table('factor_detail')
                ->select(
                    '*',
                    'factor_detail.id as id',
                    'factor_detail.price as price',
                    'factor_detail.unit as unit',
                    'units.title as unit_title'
                )
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->join('units', 'factor_detail.unit', '=', 'units.id')
                ->where('factor_detail.staff', '=', $staff)
                ->where('factor_detail.status', '=', 0)
                ->get();
        }

        $units = Unit::all();
        $products = Product::all();
        $users = User::all()->where('access', '=', 3);

        return view('factor', [
            'id' => $id,
            'factor' => $factor,
            'details' => $details,
            'units' => $units,
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
        $factor->status = 2;
        $factor->save();

        $id = $factor->id;
        $detail = FactorDetail::where('staff', '=', Auth::id())
            ->where('status', '=', 0)
            ->update([
                'factor' => $id,
                'status' => 2
            ]);

        return redirect('/factor/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function factor_status_update($factor, $status, $reject = 0)
    {
        Factor::where('id', '=', $factor)
            ->update([
                'status' => $status
            ]);

        FactorDetail::where('factor', '=', $factor)
            ->update([
                'status' => $status,
                'reject' => $reject
            ]);
    }

    public function detail_status_list($status)
    {
        $days =  request()->get('days');
        if (! $days) $days = 30;

        $details = DB::table('factor_detail')
            ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'products.name as pname', 'factors.id as fid',
                'producers.name as prname', 'producers.family as prfamily', 'users.name as name', 'users.family as family')
            ->join('products', 'factor_detail.product', '=', 'products.id')
            ->join('factors', 'factor_detail.factor', '=', 'factors.id')
            ->join('users', 'factors.user', '=', 'users.id')
            ->leftJoin('users as producers', 'factor_detail.producer', '=', 'producers.id')
            ->where('factor_detail.status', $status)
            ->where('factor_detail.created_at', '>', now()->subDays($days)->endOfDay())
            ->get();
        return view('details',
            [
                'days' => $days,
                'status' => $status,
                'details' => $details
            ]
        );
    }

    public function detail_status_update($detail, $status, $reject = 0)
    {
        FactorDetail::where('id', '=', $detail)
            ->update([
                'status' => $status,
                'reject' => $reject
            ]);
    }

    public function detail_status_counter($status)
    {
         return FactorDetail::all()->where('status', $status)->count();
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
        $id = $request->detail;

        if ($id) {

            $detail = FactorDetail::find($id);
            $detail->unit = $request->unit;
            $detail->amount = $request->number;
            $detail->save();

        } else {
            $detail = new FactorDetail();
            $detail->staff = Auth::id();
            $detail->producer = 0;
            $detail->factor = $factor;
            $detail->product = $request->product;
            $detail->price = $request->price;
            $detail->unit = $request->unit;
            $detail->amount = $request->number;
            $detail->status = 0;
            $detail->reject = 0;
            $detail->save();
        }
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
                ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'products.name as pname', 'factors.id as fid',
                    'producers.name as prname', 'producers.family as prfamily', 'users.name as name', 'users.family as family')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->join('users as producers', 'factor_detail.producer', '=', 'producers.id')
                ->where('factor_detail.producer', '=', $user)
                ->where('factor_detail.status', '!=', 0)
                ->get();
        else
            $details = DB::table('factor_detail')
                ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'products.name as pname', 'factors.id as fid',
                    'producers.name as prname', 'producers.family as prfamily', 'users.name as name', 'users.family as family')
                ->join('products', 'factor_detail.product', '=', 'products.id')
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->join('users as producers', 'factor_detail.producer', '=', 'producers.id')
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
            ->select('*', 'factors.id as id')
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
