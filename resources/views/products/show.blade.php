@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto">
    <a href="{{ route('products.index') }}" class="inline-flex items-center text-pink-500 hover:text-pink-700 font-bold mb-6 transition">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
        </svg>
        Kembali ke Daftar
    </a>

    <div class="bg-white rounded-[3rem] shadow-2xl overflow-hidden border-4 border-pink-50 flex flex-col md:flex-row">
        
        <div class="md:w-1/2 bg-pink-100 flex items-center justify-center p-8">
            <div class="relative group">
                <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}" class="rounded-3xl shadow-lg transform transition duration-500 group-hover:scale-105 group-hover:rotate-1 max-h-96 object-cover">
                <div class="absolute -bottom-4 -right-4 bg-white p-3 rounded-full shadow-md text-3xl">
                    ✨
                </div>
            </div>
        </div>

        <div class="md:w-1/2 p-10 flex flex-col justify-center">
            <h2 class="text-pink-400 text-sm font-bold tracking-widest uppercase mb-2">Detail Produk</h2>
            <h1 class="text-4xl font-extrabold text-gray-800 mb-4">{{ $product->name }}</h1>
            
            <div class="text-3xl font-bold text-pink-500 mb-6 bg-pink-50 inline-block px-4 py-2 rounded-xl self-start border border-pink-200">
                Rp {{ number_format($product->price) }}
            </div>

            <p class="text-gray-500 leading-relaxed mb-8 text-lg">
                {{ $product->description }}
            </p>

            <div class="flex space-x-3 mt-auto">
                <a href="{{ route('products.edit', $product->id) }}" class="flex-1 bg-yellow-300 hover:bg-yellow-400 text-yellow-900 font-bold py-3 rounded-2xl text-center shadow-md transition transform hover:-translate-y-1">
                    ✏️ Edit Barang
                </a>
                <button type="button" class="flex-1 bg-red-300 hover:bg-red-400 text-red-900 font-bold py-3 rounded-2xl text-center shadow-md transition transform hover:-translate-y-1 btn-delete" data-id="{{ $product->id }}">
                    🗑️ Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<form id="delete-form-{{ $product->id }}" action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>
@endsection