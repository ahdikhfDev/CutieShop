<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http; // Tambahkan ini biar downloadnya lancar

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bersihkan dulu folder images biar tidak numpuk (Opsional)
        // File::cleanDirectory(public_path('images')); 

        // 2. Pastikan folder public/images ada
        $path = public_path('images');
        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // 3. Daftar Barang Lucu & Link Gambar Baru (Lebih Stabil)
        $items = [
            [
                'name' => 'Headphone Pink Cat',
                'description' => 'Headphone gaming dengan telinga kucing lucu, bass-nya mantap!',
                'price' => 450000,
                // Gambar Headphone Pink
                'image_url' => 'https://images.unsplash.com/photo-1612444530582-fc66183b16f7?w=600&q=80' 
            ],
            [
                'name' => 'Kamera Instan Pastel',
                'description' => 'Kamera instan untuk mengabadikan momen estetik bareng bestie.',
                'price' => 1250000,
                // Gambar Kamera Pink
                'image_url' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?w=600&q=80'
            ],
            [
                'name' => 'Macarons Sweet Box',
                'description' => 'Paket macarons manis warna-warni, cocok buat kado ulang tahun.',
                'price' => 85000,
                // Gambar Macarons
                'image_url' => 'https://images.unsplash.com/photo-1569864358642-9d1684040f43?w=600&q=80'
            ],
            [
                'name' => 'Bunga Tulip Pink',
                'description' => 'Bunga tulip segar untuk hiasan meja belajar biar semangat.',
                'price' => 35000,
                // Gambar Bunga
                'image_url' => 'https://images.unsplash.com/photo-1520763185298-1b434c919102?w=600&q=80'
            ],
            [
                'name' => 'Sepatu Sneakers Lucu',
                'description' => 'Sepatu jalan-jalan warna pink soft, nyaman dipakai seharian.',
                'price' => 350000,
                // Gambar Sepatu
                'image_url' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=600&q=80'
            ],
             [
                'name' => 'Donat Strawberry',
                'description' => 'Donat dengan topping strawberry glaze yang lumer di mulut.',
                'price' => 15000,
                // Gambar Donat
                'image_url' => 'https://images.unsplash.com/photo-1551024709-8f23befc6f87?w=600&q=80'
            ],
        ];

        foreach ($items as $item) {
            try {
                // KITA PAKAI HTTP CLIENT LARAVEL (Lebih aman dari error 404/403)
                $response = Http::get($item['image_url']);

                if ($response->successful()) {
                    $filename = 'seeder_' . time() . '_' . rand(100, 999) . '.jpg';
                    
                    // Simpan gambar ke folder public
                    File::put($path . '/' . $filename, $response->body());

                    // Simpan ke database
                    Product::create([
                        'name' => $item['name'],
                        'description' => $item['description'],
                        'price' => $item['price'],
                        'image' => $filename, 
                    ]);
                    
                    $this->command->info('Berhasil download: ' . $item['name']);
                } else {
                    $this->command->error('Gagal download gambar untuk: ' . $item['name']);
                }

            } catch (\Exception $e) {
                // Kalau error, script gak berhenti, cuma lapor aja
                $this->command->error('Error: ' . $e->getMessage());
            }
        }
    }
}