<?php

namespace App\Http\Controllers;

use App\Models\Produces;
use App\Models\Product;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('product-list', ['products' => $products]);
    }

    public function add($id = null)
    {
        $product = null;
        if ($id) $product = Product::find($id);
        $code = $this->product_code();
        $units = Unit::all();
        return view('product', [
            'id' => $id,
            'product' => $product,
            'code' => $code,
            'units' => $units,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'barcode' => 'required',
            'name' => 'required',
            'unit' => 'required',
        ]);

        $barcode = $this->product_code();

        $product = new Product();
        $product->barcode = $barcode;
        $product->name = $request->name;
        $product->unit = $request->unit;
        $product->comment = $request->description;
        $product->save();

        return redirect('/product/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->comment = $request->description;
        $product->save();

        return redirect('/product/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function remove($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect('/product/list')->withErrors(['danger' => 'با موفقیت حذف شد .']);
    }

    public function get_producer(Request $request)
    {
        $product = $request->product;
        return DB::table('produces')
            ->join('products', 'produces.product', '=', 'products.id')
            ->join('users', 'produces.producer', '=', 'users.id')
            ->where('produces.product', $product)
            ->get();
    }

    public function product_counter()
    {
        return Product::all()->count();
    }

    public function product_code()
    {
        $counter = $this->product_counter();
        $counter++;
        $code = str_pad($counter, 3, 0, STR_PAD_LEFT);
        return "P$code";
    }
}
