<?php

namespace App\Http\Controllers;

use App\Helpers\PDF;
use App\Models\Factor;
use App\Models\FactorDetail;
use App\Models\Product;
use App\Models\Status;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FactorController extends Controller
{
    public function index()
    {
        $statuses = Status::all()->where('id', '>', '2');
        $access = Auth::user()->access;

        if (in_array($access, [0, 1])) {
            $factors = DB::table('factors')
                ->select('*', 'factors.id as id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->where('factors.type', '=', 1)
                ->get();
        } else {
            $user = Auth::id();
            $factors = DB::table('factors')
                ->select('*', 'factors.id as id')
                ->join('users', 'factors.user', '=', 'users.id')
                ->where('factors.user', '=', $user)
                ->where('factors.type', '=', 1)
                ->get();
        }
        return view('factor-list', [
            'factors' => $factors,
            'statuses' => $statuses,
        ]);
    }

    public function temp()
    {
        $access = Auth::user()->access;

        $factors = DB::table('factors')
            ->select('*', 'factors.id as id')
            ->join('users', 'factors.user', '=', 'users.id')
            ->where('factors.type', '=', 0)
            ->get();

        return view('factor-temp', [
            'factors' => $factors,
        ]);
    }

    public function temp_change($id)
    {
        Factor::where('id', '=', $id)
            ->update([
                'type' => 1,
            ]);

        return redirect('/factor/list')->withErrors(['success' => 'تایید با موفقیت انجام شد .']);
    }

    public function add($id = null)
    {

        $factor = null;
        $staff = Auth::id();
        $producers = User::all()->where('access', '=', 2);

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
            'producers' => $producers,
            'users' => $users
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'user' => 'required',
            'total' => 'required',
        ]);

        $status = 3;
        if (Auth::user()->access == 0) $status = 4;

        $factor = new Factor();
        $factor->code = "FFP-" . rand(1000, 9999);
        $factor->staff = Auth::id();
        $factor->user = $request->user;
        $factor->price = $request->total;
        $factor->type = $request->type;
        $factor->comment = $request->comment;
        $factor->status = $status;
        $factor->save();

        $id = $factor->id;
        $detail = FactorDetail::where('staff', '=', Auth::id())
            ->where('status', '=', 0)
            ->update([
                'factor' => $id,
                'status' => $status
            ]);

        if ($request->type)
            return redirect('/factor/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);

        return redirect('/factor/temp')->withErrors(['success' => 'با موفقیت ثبت شد .']);
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
        $access = Auth::user()->access;
        $user = Auth::id();
        $producers = User::all()->where('access', '=', 2);
        $statuses = Status::all()->where('id', '>', '2');

        $days = 30;
        if (request()->has('days')) $days = request()->get('days');
        if (request()->has('s')) $status = request()->get('s');

        $details = DB::table('factor_detail')
            ->select(
                '*',
                'factor_detail.id as id',
                'factor_detail.price as price',
                'factor_detail.status as status',
                'products.name as pname',
                'factors.id as fid',
                'producer.name as prname',
                'producer.family as prfamily',
                'users.name as name',
                'users.family as family'
            )
            ->join('products', 'factor_detail.product', '=', 'products.id')
            ->join('factors', 'factor_detail.factor', '=', 'factors.id')
            ->join('users', 'factors.user', '=', 'users.id')
            ->leftJoin('users as producer', 'factor_detail.producer', '=', 'producer.id')
            ->when($status, function ($query) use ($status) {
                $query->where('factor_detail.status', $status);
            })
            ->when($access == 2, function ($query) use ($user) {
                $query->where('factor_detail.producer', $user);
            })
            ->where('factor_detail.created_at', '>', now()->subDays($days)->endOfDay())
            ->where('factors.type', '=', 1)
            ->get();
        return view('details',
            [
                'days' => $days,
                'status' => $status,
                'details' => $details,
                'producers' => $producers,
                'statuses' => $statuses,
            ]
        );
    }

    public function store_status(Request $request){
        $this->validate($request, [
            'detail' => 'required',
        ]);

        $status = $request->status;

        $detail = FactorDetail::find($request->detail);

        if ($status == 5) {
            $detail->comment2 = $request->comment2;
        }

        if ($status == 6) {
            $date = $request->jalali;
            $detail->end_at = $this->j2m($date);
            $detail->comment2 = $request->comment2;
            if ($request->price2)
                $detail->price2 = $request->price2;
        }

        $detail->save();

        $this->detail_status_update($request->detail, $status);

        return redirect()->back()->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function detail_status_update($detail, $status, $reject = 0)
    {
        FactorDetail::where('id', '=', $detail)
            ->update([
                'status' => $status,
                'reject' => $reject
            ]);


        $detail = FactorDetail::find($detail);
        $factor = $detail->factor;

        if (
            FactorDetail::all()->where('factor', $factor)->where('status', $status)->count()
            ==
            FactorDetail::all()->where('factor', $factor)->count()
        ) {
            $this->factor_status_update($factor, $status);
        }

    }

    public function detail_status_counter($status)
    {
        $user = Auth::user()->id;
        $access = Auth::user()->access;
        if ($access == 0)
            return FactorDetail::query()
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->where('factors.type', 1)
                ->where('factor_detail.status', $status)
                ->count();
        if ($access == 1)
            return FactorDetail::query()
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->where('factors.type', 1)
                ->where('factor_detail.status', $status)
                ->count();
        if ($access == 2)
            return FactorDetail::query()
                ->join('factors', 'factor_detail.factor', '=', 'factors.id')
                ->where('factors.type', 1)
                ->where('factor_detail.status', $status)
                ->where('factor_detail.status', $status)
                ->where('factor_detail.producer', $user)
                ->count();
    }

    public function store_detail(Request $request)
    {
        $this->validate($request, [
            'factor' => 'required',
            'product' => 'required',
            'price' => 'required',
            'amount' => 'required',
        ]);

        $factor = $request->factor;
        $id = $request->detail;

        $status = 0;

        if ($factor) {
            $status = Factor::find($factor)->status;
        }

        if ($id) {

            $detail = FactorDetail::find($id);
            $detail->unit = $request->unit;
            $detail->amount = $this->p2e($request->amount);
            $detail->price = $this->p2e($request->price);
            if ($request->producer) {
                $detail->producer = $request->producer;
                $detail->status = $status;
            }

            if($request->hasFile('file')) {
                $code = rand(100, 999);
                $path = public_path("../uploads");
                $file = $request->file('file');
                $fileName = $code . Verta()->format(" Y-m-d H-i-s ") . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $detail->file = $fileName;
            }

            $detail->save();

        } else {
            $detail = new FactorDetail();
            $detail->staff = Auth::id();
            $detail->producer = 0;
            $detail->factor = $factor;
            $detail->product = $request->product;
            $detail->price = $this->p2e($request->price);
            $detail->unit = $request->unit;
            $detail->amount = $this->p2e($request->amount);
            $detail->status = $status;
            $detail->reject = 0;
            if ($request->producer) {
                $detail->producer = $request->producer;
            }

            if($request->hasFile('file')) {
                $code = rand(100, 999);
                $path = public_path("../uploads");
                $file = $request->file('file');
                $fileName = $code . Verta()->format(" Y-m-d H-i-s ") . $file->getClientOriginalName();
                $file->move($path, $fileName);
                $detail->file = $fileName;
            }

            $detail->save();
        }
        if ($factor)
            return redirect("/factor/show/$factor")->withErrors(['success' => 'با موفقیت ثبت شد .']);
        else
            return redirect('/factor/show')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function store_producer(Request $request)
    {
        $this->validate($request, [
            'detail' => 'required',
            'producer' => 'required',
        ]);

        $detail = FactorDetail::find($request->detail);
        $detail->producer = $request->producer;
        $detail->comment = $request->comment;

        if($request->hasFile('file')) {
            $code = rand(100, 999);
            $path = public_path("../uploads");
            $file = $request->file('file');
            $fileName = $code . Verta()->format(" Y-m-d H-i-s ") . $file->getClientOriginalName();
            $file->move($path, $fileName);
            $detail->file = $fileName;
        }

        $detail->save();

        $this->detail_status_update($request->detail, 4);

        return redirect()->back()->withErrors(['success' => 'سفارش با موفقیت منتقل شد .']);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'id' => 'required',
            'total' => 'required',
        ]);

        $factor = Factor::find($id);
        $factor->price = $request->total;
        $factor->comment = $request->comment;
        $factor->type = $request->type;
        $factor->save();


        if ($request->type)
            return redirect('/factor/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);

        return redirect('/factor/temp')->withErrors(['success' => 'با موفقیت ثبت شد .']);
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
        if ($access == 3) return Factor::all()->where('user', $user)->where('type', 1)->count();
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
            ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'units.title as utitle')
            ->join('products', 'factor_detail.product', '=', 'products.id')
            ->join('units', 'factor_detail.unit', '=', 'units.id')
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
            ->select('*', 'factor_detail.id as id', 'factor_detail.price as price', 'units.title as utitle')
            ->join('products', 'factor_detail.product', '=', 'products.id')
            ->join('units', 'factor_detail.unit', '=', 'units.id')

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
