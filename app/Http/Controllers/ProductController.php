<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            $imageName = time().'.'.$request->image->extension();  
            // Pindahkan gambar ke folder public/images
            $request->image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }

        Product::create($input);
        return redirect()->route('products.index')->with('success', 'Barang lucu berhasil ditambah! 🌸');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if(File::exists(public_path('images/'.$product->image))){
                File::delete(public_path('images/'.$product->image));
            }
            
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        } else {
            unset($input['image']);
        }

        $product->update($input);
        return redirect()->route('products.index')->with('success', 'Data barang berhasil diupdate! ✨');
    }
    public function show($id)
    {
        $product = Product::find($id);
        // Kita kirim response berupa JSON
        return response()->json($product);
    }

    public function destroy(Product $product)
    {
        if(File::exists(public_path('images/'.$product->image))){
            File::delete(public_path('images/'.$product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus 👋');
    }
}