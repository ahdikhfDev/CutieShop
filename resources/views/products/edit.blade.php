@extends('layout')

@section('content')
<div class="max-w-lg mx-auto bg-white p-8 rounded-[2rem] shadow-xl border-4 border-pink-100 relative">
    
    <div class="absolute -top-3 -left-3 bg-pink-400 text-white px-4 py-1 rounded-full shadow-lg font-bold text-sm transform -rotate-12">
        Mode Edit 🎀
    </div>

    <h2 class="text-2xl font-bold text-pink-500 mb-6 text-center">Update Barang Cantik</h2>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        
        <div class="mb-5">
            <label class="block text-pink-400 font-bold mb-2 ml-1">Nama Barang</label>
            <input type="text" name="name" value="{{ $product->name }}" class="w-full px-5 py-3 rounded-2xl bg-pink-50 border-2 border-transparent focus:border-pink-300 focus:bg-white focus:outline-none text-pink-600 transition">
        </div>

        <div class="mb-5">
            <label class="block text-pink-400 font-bold mb-2 ml-1">Deskripsi</label>
            <textarea name="description" rows="4" class="w-full px-5 py-3 rounded-2xl bg-pink-50 border-2 border-transparent focus:border-pink-300 focus:bg-white focus:outline-none text-pink-600 transition">{{ $product->description }}</textarea>
        </div>

        <div class="mb-5">
            <label class="block text-pink-400 font-bold mb-2 ml-1">Harga (Rp)</label>
            <input type="number" name="price" value="{{ $product->price }}" class="w-full px-5 py-3 rounded-2xl bg-pink-50 border-2 border-transparent focus:border-pink-300 focus:bg-white focus:outline-none text-pink-600 transition">
        </div>

        <div class="mb-8">
            <label class="block text-pink-400 font-bold mb-2 ml-1">Ganti Gambar?</label>
            
            <div class="mb-3 flex items-center space-x-4 bg-pink-50 p-3 rounded-xl">
                <img src="{{ asset('images/'.$product->image) }}" alt="Current Image" class="w-16 h-16 rounded-lg object-cover border-2 border-white shadow-sm">
                <span class="text-xs text-pink-400">Gambar saat ini</span>
            </div>

            <input type="file" name="image" class="block w-full text-sm text-pink-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-bold file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 transition"/>
            <p class="text-xs text-gray-400 mt-2 ml-2">*Kosongkan jika tidak ingin mengganti gambar.</p>
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('products.index') }}" class="text-gray-400 font-bold hover:text-gray-600 transition">Batal</a>
            <button type="submit" class="bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-bold py-3 px-10 rounded-full shadow-lg transition transform hover:scale-105">
                Simpan Perubahan ✨
            </button>
        </div>
    </form>
</div>
@endsection