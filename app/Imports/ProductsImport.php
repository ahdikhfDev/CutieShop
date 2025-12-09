<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow; 

class ProductsImport implements ToModel, WithStartRow
{
    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2; 
    }

    public function model(array $row)
    {


        if (!isset($row[2]) || !is_numeric($row[2])) {
            return null;
        }

        return new Product([
            'name'        => $row[1], 
            'price'       => $row[2], 
            'description' => $row[3] ?? '-', 
            'image'       => 'default.jpg',
        ]);
    }
}