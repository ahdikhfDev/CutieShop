<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('products.index');
});


Route::get('products/export-pdf', [ProductController::class, 'exportPdf'])->name('products.exportPdf');
Route::get('products/export-excel', [ProductController::class, 'exportExcel'])->name('products.exportExcel');
Route::post('products/import-excel', [ProductController::class, 'importExcel'])->name('products.importExcel');



Route::resource('products', ProductController::class);