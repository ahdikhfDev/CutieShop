@extends('layout')

@section('content')

<div class="flex flex-col xl:flex-row justify-between items-start xl:items-center mb-8 gap-5 px-4 md:px-0">
    
    <div class="relative w-full xl:w-auto flex-grow max-w-2xl group">
        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
            <svg class="h-5 w-5 text-pink-300 group-focus-within:text-pink-500 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
        </div>
        <input type="text" id="searchInput" class="w-full bg-white border-2 border-pink-100 text-pink-600 text-sm focus:border-pink-300 focus:ring-0 pl-11 pr-4 py-3 rounded-full placeholder-pink-300 shadow-sm transition-all" placeholder="Cari barang cantik disini... 🎀">
    </div>
    
    <div class="flex flex-wrap gap-3 w-full xl:w-auto justify-end">
        
        <a href="{{ route('products.exportPdf') }}" class="group flex items-center gap-2 px-5 py-2.5 bg-red-50 hover:bg-red-100 text-red-400 hover:text-red-500 rounded-full font-bold text-xs transition-all shadow-sm border border-red-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
            <span>PDF</span>
        </a>

        <a href="{{ route('products.exportExcel') }}" class="group flex items-center gap-2 px-5 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-500 hover:text-emerald-600 rounded-full font-bold text-xs transition-all shadow-sm border border-emerald-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            <span>Excel</span>
        </a>

        <button id="btnOpenImport" type="button" class="group flex items-center gap-2 px-5 py-2.5 bg-amber-50 hover:bg-amber-100 text-amber-500 hover:text-amber-600 rounded-full font-bold text-xs transition-all shadow-sm border border-amber-100">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
            <span>Upload</span>
        </button>

        <a href="{{ route('products.create') }}" class="group flex items-center gap-2 px-6 py-2.5 bg-gradient-to-r from-pink-400 to-pink-500 hover:from-pink-500 hover:to-pink-600 text-white rounded-full font-bold text-xs shadow-lg shadow-pink-200 transform hover:-translate-y-0.5 transition-all">
            <span class="text-lg leading-none">+</span> Tambah Barang
        </a>
    </div>
</div>

<div class="hidden md:block bg-white rounded-[2rem] shadow-xl border-4 border-pink-50 overflow-hidden mx-4 md:mx-0 mb-10">
    <table class="w-full text-left">
        <thead class="bg-pink-100 text-pink-500">
            <tr>
                <th class="py-5 px-6 font-bold text-sm">Preview</th>
                <th class="py-5 px-6 font-bold text-sm">Nama Produk</th>
                <th class="py-5 px-6 font-bold text-sm">Harga</th>
                <th class="py-5 px-6 font-bold text-sm text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-pink-50">
            @foreach ($products as $product)
            <tr class="hover:bg-pink-50/50 transition duration-300 search-item group">
                <td class="py-4 px-6 w-32">
                    <div class="h-16 w-16 rounded-2xl overflow-hidden border-2 border-pink-100 shadow-sm relative group-hover:scale-110 transition duration-300">
                        <img src="{{ asset('images/'.$product->image) }}" class="object-cover h-full w-full">
                    </div>
                </td>
                <td class="py-4 px-6">
                    <div class="font-bold text-pink-600 mb-1 text-base search-text">{{ $product->name }}</div>
                    <div class="text-xs text-gray-400 truncate max-w-xs search-desc">{{ Str::limit($product->description, 50) }}</div>
                </td>
                <td class="py-4 px-6">
                    <span class="inline-block bg-pink-100 text-pink-500 px-3 py-1 rounded-full text-xs font-bold border border-pink-200">
                        Rp {{ number_format($product->price) }}
                    </span>
                </td>
                <td class="py-4 px-6">
                    <div class="flex justify-center">
                        @include('products.partials.actions')
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <div id="noResultsDesktop" class="hidden p-12 text-center">
        <div class="text-4xl mb-2">🥺</div>
        <div class="text-pink-400 font-bold">Yah, barangnya nggak ketemu...</div>
    </div>

    @if($products->isEmpty())
        <div class="p-12 text-center text-pink-400 font-bold">
            Data masih kosong nih kak! 🌸
        </div>
    @endif
</div>

<div class="grid grid-cols-1 gap-6 md:hidden px-4" id="mobileGrid">
    @foreach ($products as $product)
    <div class="bg-white p-5 rounded-[1.5rem] shadow-lg border-2 border-pink-50 search-item relative overflow-hidden">
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-pink-100 rounded-full opacity-50 z-0"></div>
        
        <div class="flex gap-4 items-start relative z-10">
            <div class="w-20 h-24 flex-shrink-0 rounded-xl overflow-hidden shadow-md border border-pink-100">
                <img src="{{ asset('images/'.$product->image) }}" class="w-full h-full object-cover">
            </div>

            <div class="flex-1 min-w-0">
                <h3 class="text-pink-600 font-bold text-lg leading-tight mb-1 truncate search-text">{{ $product->name }}</h3>
                <div class="text-pink-400 font-bold text-sm mb-2">Rp {{ number_format($product->price) }}</div>
                <p class="text-gray-400 text-xs line-clamp-2 mb-4 search-desc">{{ $product->description }}</p>
                
                <div class="flex justify-start">
                    @include('products.partials.actions')
                </div>
            </div>
        </div>
    </div>
    @endforeach
    
    <div id="noResultsMobile" class="hidden p-8 text-center bg-white rounded-2xl shadow-sm border border-pink-100">
        <span class="text-pink-400 font-bold">Barang tidak ditemukan 🥺</span>
    </div>
</div>

<div id="importModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div id="overlayImport" class="fixed inset-0 bg-pink-900/20 backdrop-blur-sm transition-opacity"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="relative bg-white w-full max-w-lg rounded-[2rem] shadow-2xl p-8 border-4 border-pink-100">
            
            <div class="absolute -top-3 left-1/2 transform -translate-x-1/2 bg-amber-400 text-white px-4 py-1 rounded-full font-bold text-xs shadow-md">
                Upload File Excel 📁
            </div>

            <h3 class="text-xl font-bold text-pink-500 text-center mb-6 mt-2">
                Import Data Baru
            </h3>

            <form action="{{ route('products.importExcel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-6 bg-pink-50 rounded-2xl p-4 border border-pink-100 border-dashed border-2 text-center hover:bg-pink-100 transition cursor-pointer relative group">
                    <input type="file" name="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" required>
                    <div class="text-pink-400 group-hover:text-pink-600 transition">
                        <div class="text-3xl mb-2">📥</div>
                        <span class="text-sm font-bold">Klik untuk pilih file Excel</span>
                        <p class="text-xs text-pink-300 mt-1">.xlsx atau .xls</p>
                    </div>
                </div>

                <div class="flex gap-3">
                    <button type="button" id="btnCloseImport" class="flex-1 py-3 text-pink-400 font-bold hover:bg-pink-50 rounded-xl transition">
                        Batal
                    </button>
                    <button type="submit" class="flex-1 py-3 bg-gradient-to-r from-amber-400 to-amber-500 hover:from-amber-500 hover:to-amber-600 text-white font-bold rounded-xl shadow-lg shadow-amber-200 transition transform hover:scale-105">
                        Upload Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div id="overlayDetail" class="fixed inset-0 bg-pink-900/20 backdrop-blur-sm transition-opacity"></div>
    <div class="flex items-center justify-center min-h-screen p-4">
        
        <div class="relative bg-white w-full max-w-4xl rounded-[2.5rem] shadow-2xl flex flex-col md:flex-row overflow-hidden border-4 border-pink-100">
            <button onclick="closeModal()" class="absolute top-4 right-4 bg-white text-pink-400 hover:text-pink-600 w-8 h-8 rounded-full shadow-md z-30 font-bold text-xl flex items-center justify-center transition">&times;</button>

            <div class="md:w-5/12 relative h-64 md:h-auto bg-pink-50">
                <img id="modalImage" src="" class="w-full h-full object-cover">
            </div>

            <div class="md:w-7/12 p-8 md:p-10 flex flex-col">
                <div class="mb-1">
                    <span class="bg-pink-100 text-pink-500 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide">Detail Produk</span>
                </div>
                
                <h2 id="modalName" class="text-3xl font-bold text-pink-600 mt-4 mb-2"></h2>
                
                <div class="flex items-center gap-2 mb-6">
                    <span class="text-2xl font-bold text-pink-500">Rp <span id="modalPrice"></span></span>
                    <span class="bg-emerald-100 text-emerald-500 px-2 py-0.5 rounded-full text-[10px] font-bold border border-emerald-200">READY STOCK</span>
                </div>

                <div class="bg-pink-50 p-6 rounded-2xl mb-8 border border-pink-100">
                    <p id="modalDescription" class="text-gray-500 text-sm leading-relaxed"></p>
                </div>

                <div class="mt-auto">
                    <button onclick="closeModal()" class="w-full bg-pink-100 text-pink-500 hover:bg-pink-200 py-3 rounded-xl font-bold transition">
                        Tutup Detail
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    
    // 1. SEARCH LOGIC
    const searchInput = document.getElementById('searchInput');
    const searchItems = document.querySelectorAll('.search-item');
    const noResultsDesktop = document.getElementById('noResultsDesktop');
    const noResultsMobile = document.getElementById('noResultsMobile');

    if(searchInput) {
        searchInput.addEventListener('keyup', function(e) {
            const term = e.target.value.toLowerCase();
            let hasVisibleItems = false;

            searchItems.forEach(item => {
                const nameEl = item.querySelector('.search-text');
                const descEl = item.querySelector('.search-desc');
                const name = nameEl ? nameEl.textContent.toLowerCase() : '';
                const desc = descEl ? descEl.textContent.toLowerCase() : '';

                if(name.includes(term) || desc.includes(term)) {
                    item.classList.remove('hidden');
                    hasVisibleItems = true;
                } else {
                    item.classList.add('hidden');
                }
            });

            if (!hasVisibleItems) {
                if(noResultsDesktop) noResultsDesktop.classList.remove('hidden');
                if(noResultsMobile) noResultsMobile.classList.remove('hidden');
            } else {
                if(noResultsDesktop) noResultsDesktop.classList.add('hidden');
                if(noResultsMobile) noResultsMobile.classList.add('hidden');
            }
        });
    }

    // 2. IMPORT MODAL LOGIC
    const importModal = document.getElementById('importModal');
    const btnOpenImport = document.getElementById('btnOpenImport');
    const btnCloseImport = document.getElementById('btnCloseImport');
    const overlayImport = document.getElementById('overlayImport');

    if(btnOpenImport) {
        btnOpenImport.addEventListener('click', () => importModal.classList.remove('hidden'));
    }
    if(btnCloseImport) {
        btnCloseImport.addEventListener('click', () => importModal.classList.add('hidden'));
    }
    if(overlayImport) {
        overlayImport.addEventListener('click', () => importModal.classList.add('hidden'));
    }

    // 3. DETAIL MODAL LOGIC
    const detailModal = document.getElementById('detailModal');
    const overlayDetail = document.getElementById('overlayDetail');

    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-detail'); 
        if (btn) { 
            const url = btn.getAttribute('data-url');
            document.getElementById('modalName').innerText = "Sedang memuat... 🎀";
            detailModal.classList.remove('hidden');

            fetch(url)
                .then(r => r.json())
                .then(data => {
                    document.getElementById('modalName').innerText = data.name;
                    document.getElementById('modalPrice').innerText = new Intl.NumberFormat('id-ID').format(data.price);
                    document.getElementById('modalDescription').innerText = data.description;
                    document.getElementById('modalImage').src = `/images/${data.image}`;
                })
                .catch(err => {
                    document.getElementById('modalName').innerText = "Gagal memuat data 🥺";
                });
        }
    });

    window.closeModal = function() {
        if(detailModal) detailModal.classList.add('hidden');
    }
    
    if(overlayDetail) {
        overlayDetail.addEventListener('click', closeModal);
    }
});
</script>

@endsection