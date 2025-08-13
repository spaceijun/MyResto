<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin/product/index', [
            'title' => 'Produk',
            'active' => 'product',
            'page' => 'Produk',
            'products' => Product::with('category')->get(),

        ]);
    }

    public function create()
    {

        return view('admin/product/create', [
            'title' => 'Tambah Produk',
            'active' => 'product',
            'page' => 'Tambah Produk',
            'product' => new Product,
            'button_name' => 'Simpan',
            'categories' => Category::all(),
        ]);
    }
    public function productList()
    {
        // $products = Product::with('category')->get();
        $categories = Category::with('products')->get();
        // return $categories;
        return view('front.products', compact('categories'));
    }

    public function store(ProductRequest $request)
    {
        if ($request->ajax()) {
            $dtProd = $request->only(['name', 'category_id', 'price', 'description']);
            if ($request->hasFile('file')) {

                $path = $request->file('file')->store('public/images');


                $dtProd['image'] = $path;
            }

            Product::create($dtProd);
            return response()->json([
                'status' => 'success',
                'msg' => 'Berhasil menambah data produk',
            ]);
        }
    }

    public function edit(Product $product)
    {

        return view('admin/product/edit', [
            'title' => 'Ubah Produk',
            'active' => 'product',
            'page' => 'Ubah Produk',
            'product' => $product,
            'button_name' => 'Ubah',
            'categories' => Category::all(),
        ]);
    }

    public function update(ProductRequest $request, Product $product)
    {
        // dd($request->all());
        if ($request->ajax()) {
            $dtProd = $request->only(['name', 'category_id', 'price', 'description']);
            if ($request->hasFile('file')) {

                if (Storage::exists($product->image)) {
                    Storage::delete($product->image);
                }
                $path = $request->file('file')->store('public/images');


                $dtProd['image'] = $path;
            }

            $product->update($dtProd);
            return response()->json([
                'status' => 'success',
                'msg' => 'Berhasil mengubah data produk',
            ]);
        }
    }
    public function destroy(Product $product)
    {
        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect('product')->with('success', 'Berhasil menghapus data produk');
    }
}
