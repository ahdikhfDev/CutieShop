<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::select('id', 'name', 'price', 'description')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Nama Produk', 'Harga', 'Deskripsi'];
    }
}