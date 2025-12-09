@extends('layout')

@section('content')

<div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
    <h2 class="text-2xl font-bold text-pink-600">Daftar Koleksi 🛍️</h2>
    <a href="{{ route('products.create') }}" class="w-full md:w-auto bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-6 rounded-full shadow-lg transform hover:scale-105 transition duration-300 flex items-center justify-center">
        <span class="mr-2">✨</span> Tambah Barang
    </a>
</div>

<div class="hidden md:block bg-white rounded-[20px] shadow-xl overflow-hidden border border-pink-100">
    <div class="overflow-x-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr class="bg-pink-100 text-left">
                    <th class="py-4 px-6 text-pink-600 font-bold uppercase tracking-wider text-sm">Gambar</th>
                    <th class="py-4 px-6 text-pink-600 font-bold uppercase tracking-wider text-sm">Nama</th>
                    <th class="py-4 px-6 text-pink-600 font-bold uppercase tracking-wider text-sm">Harga</th>
                    <th class="py-4 px-6 text-pink-600 font-bold uppercase tracking-wider text-sm text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-pink-50">
                @foreach ($products as $product)
                <tr class="hover:bg-pink-50 transition duration-200">
                    <td class="py-3 px-6">
                        <div class="h-12 w-12 rounded-lg overflow-hidden border border-pink-200">
                            <img src="{{ asset('images/'.$product->image) }}" class="object-cover h-full w-full">
                        </div>
                    </td>
                    <td class="py-3 px-6 font-bold text-gray-700">{{ $product->name }}</td>
                    <td class="py-3 px-6 text-pink-500 font-bold">Rp {{ number_format($product->price) }}</td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center space-x-2">
                            @include('products.partials.actions') 
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="grid grid-cols-1 gap-4 md:hidden">
    @foreach ($products as $product)
    <div class="bg-white p-4 rounded-2xl shadow-md border border-pink-100 flex items-center space-x-4">
        <div class="flex-shrink-0">
            <img src="{{ asset('images/'.$product->image) }}" class="h-16 w-16 rounded-xl object-cover border border-pink-200 shadow-sm">
        </div>
        
        <div class="flex-1 min-w-0">
            <p class="text-sm font-bold text-gray-900 truncate">{{ $product->name }}</p>
            <p class="text-sm text-pink-500 font-bold">Rp {{ number_format($product->price) }}</p>
        </div>

        <div class="flex space-x-1">
             @include('products.partials.actions')
        </div>
    </div>
    @endforeach
</div>

<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-pink-900 bg-opacity-30 transition-opacity backdrop-blur-sm" onclick="closeModal()"></div>

    <div class="flex items-center justify-center min-h-screen p-4 text-center">
        <div class="relative bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 w-full max-w-2xl border-4 border-pink-100 flex flex-col md:flex-row">
            
            <button onclick="closeModal()" class="absolute top-3 right-3 z-10 bg-white/80 hover:bg-white text-pink-600 rounded-full w-8 h-8 flex items-center justify-center font-bold shadow-sm transition">
                ✕
            </button>

            <div class="w-full md:w-1/2 bg-pink-50 p-4 flex items-center justify-center relative h-48 md:h-auto">
                <img id="modalImage" src="" alt="Product Image" class="rounded-xl shadow-md object-cover h-full w-full md:w-auto md:max-h-64 border-2 border-white">
            </div>

            <div class="w-full md:w-1/2 p-6 flex flex-col">
                <h3 class="text-pink-400 text-xs font-bold tracking-widest uppercase mb-1">Detail Produk</h3>
                <h2 id="modalName" class="text-2xl md:text-3xl font-extrabold text-gray-800 mb-2 leading-tight"></h2>
                
                <div class="self-start bg-pink-100 text-pink-600 px-3 py-1 rounded-lg font-bold text-lg mb-4">
                    Rp <span id="modalPrice"></span>
                </div>

                <div class="overflow-y-auto max-h-32 md:max-h-none mb-6">
                    <p class="text-gray-500 text-sm leading-relaxed" id="modalDescription">
                        Loading...
                    </p>
                </div>

                <button onclick="closeModal()" class="mt-auto w-full bg-pink-400 hover:bg-pink-500 text-white font-bold py-3 px-4 rounded-xl shadow-md transition transform active:scale-95">
                    Tutup 🌸
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    const modal = document.getElementById('detailModal');
    
    // Kita pakai Event Delegation biar tombol di Desktop & Mobile jalan semua
    document.addEventListener('click', function(e) {
        // Cek jika yang diklik adalah tombol detail atau anaknya (icon mata)
        const btn = e.target.closest('.btn-detail');
        if (btn) {
            const url = btn.getAttribute('data-url');
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modalName').innerText = data.name;
                    document.getElementById('modalPrice').innerText = new Intl.NumberFormat('id-ID').format(data.price);
                    document.getElementById('modalDescription').innerText = data.description;
                    document.getElementById('modalImage').src = `/images/${data.image}`;
                    modal.classList.remove('hidden');
                })
                .catch(error => console.error('Error:', error));
        }
    });

    function closeModal() {
        modal.classList.add('hidden');
    }
</script>

@endsection