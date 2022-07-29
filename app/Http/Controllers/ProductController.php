<?php

namespace App\Http\Controllers;

use App\Models\Produces;
use App\Models\Product;
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
        $producers = User::all()->where('access', 2);
        foreach ($producers as $producer) {
            $exist = Produces::all()
                ->where('producer', $producer->id)
                ->where('product', $id)
                ->first();
            $producer->selected = (bool)$exist;
        }
        return view('product', [
            'id' => $id,
            'product' => $product,
            'producers' => $producers,
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'barcode' => 'required',
            'price' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->comment = $request->description;
        $product->save();

        $producers = $request->producer;
        foreach ($producers as $p) {
            $produces = new Produces();
            $produces->producer = $p;
            $produces->product = $product->id;
            $produces->save();
        }

        return redirect('/product/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [
            'id' => 'required',
            'name' => 'required',
            'barcode' => 'required',
            'price' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->comment = $request->description;
        $product->save();

        $produces = Produces::where('product', $product->id);
        $produces->delete();

        $producers = $request->producer;
        foreach ($producers as $p) {
            $produces = new Produces();
            $produces->producer = $p;
            $produces->product = $product->id;
            $produces->save();
        }

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
}
