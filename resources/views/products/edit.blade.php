@extends('layout')

@section('content')
<div class="px-4 py-2 md:py-6">
    
    <div class="w-full max-w-lg mx-auto bg-white p-6 md:p-8 rounded-[1.5rem] md:rounded-[2rem] shadow-xl border-4 border-pink-100 relative mt-4">
        
        <div class="absolute -top-3 -left-2 md:-left-3 bg-pink-400 text-white px-3 py-1 md:px-4 md:py-1 rounded-full shadow-lg font-bold text-xs md:text-sm transform -rotate-12 z-10">
            Mode Edit 🎀
        </div>

        <h2 class="text-xl md:text-2xl font-bold text-pink-500 mb-6 text-center">Update Barang Cantik</h2>

        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT') 
            
            <div class="mb-4 md:mb-5">
                <label class="block text-pink-400 font-bold mb-2 ml-1 text-sm md:text-base">Nama Barang</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full px-4 py-3 md:px-5 md:py-3 rounded-2xl bg-pink-50 border-2 border-transparent focus:border-pink-300 focus:bg-white focus:outline-none text-pink-600 transition text-sm md:text-base">
            </div>

            <div class="mb-4 md:mb-5">
                <label class="block text-pink-400 font-bold mb-2 ml-1 text-sm md:text-base">Deskripsi</label>
                <textarea name="description" rows="4" class="w-full px-4 py-3 md:px-5 md:py-3 rounded-2xl bg-pink-50 border-2 border-transparent focus:border-pink-300 focus:bg-white focus:outline-none text-pink-600 transition text-sm md:text-base">{{ $product->description }}</textarea>
            </div>

            <div class="mb-4 md:mb-5">
                <label class="block text-pink-400 font-bold mb-2 ml-1 text-sm md:text-base">Harga (Rp)</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full px-4 py-3 md:px-5 md:py-3 rounded-2xl bg-pink-50 border-2 border-transparent focus:border-pink-300 focus:bg-white focus:outline-none text-pink-600 transition text-sm md:text-base">
            </div>

            <div class="mb-8">
                <label class="block text-pink-400 font-bold mb-2 ml-1 text-sm md:text-base">Ganti Gambar?</label>
                
                <div class="mb-3 flex items-center space-x-3 md:space-x-4 bg-pink-50 p-3 rounded-xl">
                    <img src="{{ asset('images/'.$product->image) }}" alt="Current Image" class="w-14 h-14 md:w-16 md:h-16 rounded-lg object-cover border-2 border-white shadow-sm flex-shrink-0">
                    <div class="flex flex-col">
                        <span class="text-xs font-bold text-pink-500">Gambar saat ini</span>
                        <span class="text-[10px] md:text-xs text-pink-300 truncate max-w-[150px]">{{ $product->image }}</span>
                    </div>
                </div>

                <input type="file" name="image" class="block w-full text-sm text-pink-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs md:file:text-sm file:font-bold file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 transition"/>
                <p class="text-[10px] md:text-xs text-gray-400 mt-2 ml-2">*Kosongkan jika tidak ingin mengganti gambar.</p>
            </div>

            <div class="flex flex-col-reverse md:flex-row justify-between items-center gap-4">
                
                <a href="{{ route('products.index') }}" class="w-full md:w-auto text-center text-gray-400 font-bold hover:text-gray-600 transition py-2 text-sm md:text-base">
                    Batal
                </a>

                <button type="submit" class="w-full md:w-auto bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white font-bold py-3 px-10 rounded-full shadow-lg transition transform hover:scale-105 active:scale-95 text-sm md:text-base">
                    Simpan Perubahan ✨
                </button>
            </div>

        </form>
    </div>
</div>
@endsection