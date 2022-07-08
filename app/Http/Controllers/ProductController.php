<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

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
        return view('product', ['id' => $id, 'product' => $product]);
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
        $product->description = $request->description;
        $product->save();
        return redirect('/product/list')->withErrors(['success' => 'با موفقیت ثبت شد .']);
    }

    public function remove($id) {
        $product = Product::find($id);
        $product->delete();
        return redirect('/product/list')->withErrors(['danger' => 'با موفقیت حذف شد .']);
    }
}
