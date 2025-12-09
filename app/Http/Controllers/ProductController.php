<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    // CREATE
    public function create()
    {
        return view('products.create');
    }

    // SAVE
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
            $request->image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }

        Product::create($input);
        return redirect()->route('products.index')->with('success', 'Barang lucu berhasil ditambah! 🌸');
    }

    // EDIT
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $input = $request->all();

        if ($request->hasFile('image')) {
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
        return response()->json($product);
    }

    // DELETE
    public function destroy(Product $product)
    {
        if(File::exists(public_path('images/'.$product->image))){
            File::delete(public_path('images/'.$product->image));
        }
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Barang berhasil dihapus 👋');
    }

    // EXPORT EXCEL
    public function exportExcel()
    {
        return Excel::download(new ProductsExport, 'laporan-produk.xlsx');
    }

    // IMPORT EXCEL
    public function importExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        Excel::import(new ProductsImport, $request->file('file'));

        return redirect()->route('products.index')->with('success', 'Data berhasil diimport ke System!');
    }

    // EXPORT PDF
    public function exportPdf()
    {
        $products = Product::all();
        $pdf = Pdf::loadView('products.pdf', compact('products'));
        
        return $pdf->download('laporan-produk.pdf');
    }
}