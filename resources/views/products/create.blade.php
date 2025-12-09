@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-3xl shadow-xl border-4 border-pink-100">
    <h2 class="text-2xl font-bold text-pink-500 mb-6 text-center">✨ Tambah Barang ✨</h2>

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label class="block text-pink-400 font-bold mb-2">Nama Barang</label>
            <input type="text" name="name" class="w-full px-4 py-3 rounded-xl bg-pink-50 border-transparent focus:border-pink-300 focus:bg-white focus:ring-0 text-pink-600" placeholder="Contoh: Boneka Beruang">
        </div>

        <div class="mb-4">
            <label class="block text-pink-400 font-bold mb-2">Deskripsi</label>
            <textarea name="description" class="w-full px-4 py-3 rounded-xl bg-pink-50 border-transparent focus:border-pink-300 focus:bg-white focus:ring-0 text-pink-600" placeholder="Deskripsi barangnya..."></textarea>
        </div>

        <div class="mb-4">
            <label class="block text-pink-400 font-bold mb-2">Harga (Rp)</label>
            <input type="number" name="price" class="w-full px-4 py-3 rounded-xl bg-pink-50 border-transparent focus:border-pink-300 focus:bg-white focus:ring-0 text-pink-600">
        </div>

        <div class="mb-6">
            <label class="block text-pink-400 font-bold mb-2">Upload Gambar Lucu</label>
            <input type="file" name="image" class="block w-full text-sm text-pink-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200"/>
        </div>

        <div class="flex justify-between">
            <a href="{{ route('products.index') }}" class="text-gray-400 font-bold py-3">Batal</a>
            <button type="submit" class="bg-pink-400 hover:bg-pink-500 text-white font-bold py-3 px-8 rounded-full shadow-md transition transform hover:-translate-y-1">
                Simpan 💖
            </button>
        </div>
    </form>
</div>
@endsection