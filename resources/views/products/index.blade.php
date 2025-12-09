@extends('layout')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-pink-600">Daftar Koleksi 🛍️</h2>
    <a href="{{ route('products.create') }}" class="bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-6 rounded-full shadow-lg transform hover:scale-105 transition duration-300 flex items-center">
        <span class="mr-2">✨</span> Tambah Barang
    </a>
</div>

<div class="bg-white rounded-[20px] shadow-xl overflow-hidden border border-pink-100">
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
                            
                            <a href="javascript:void(0)" 
                               data-url="{{ route('products.show', $product->id) }}" 
                               class="w-8 h-8 bg-blue-300 hover:bg-blue-400 text-white rounded-full flex items-center justify-center shadow-md transition transform hover:scale-110 btn-detail">
                                👁️
                            </a>

                            <a href="{{ route('products.edit', $product->id) }}" class="w-8 h-8 bg-yellow-300 hover:bg-yellow-400 text-white rounded-full flex items-center justify-center shadow-md transition transform hover:scale-110">
                                ✏️
                            </a>

                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-8 h-8 bg-red-300 hover:bg-red-400 text-white rounded-full flex items-center justify-center shadow-md transition transform hover:scale-110 btn-delete" data-id="{{ $product->id }}">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="fixed inset-0 bg-pink-900 bg-opacity-30 transition-opacity backdrop-blur-sm" onclick="closeModal()"></div>

    <div class="flex items-center justify-center min-h-screen p-4 text-center sm:p-0">
        <div class="relative bg-white rounded-[2rem] text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full border-4 border-pink-100">
            
            <button onclick="closeModal()" class="absolute top-4 right-4 bg-pink-100 hover:bg-pink-200 text-pink-600 rounded-full w-8 h-8 flex items-center justify-center font-bold transition">
                ✕
            </button>

            <div class="flex flex-col md:flex-row">
                <div class="md:w-1/2 bg-pink-50 p-6 flex items-center justify-center">
                    <img id="modalImage" src="" alt="Product Image" class="rounded-2xl shadow-lg object-cover max-h-64 border-2 border-white">
                </div>

                <div class="md:w-1/2 p-8">
                    <h3 class="text-pink-400 text-xs font-bold tracking-widest uppercase mb-1">Detail Produk</h3>
                    <h2 id="modalName" class="text-3xl font-extrabold text-gray-800 mb-2"></h2>
                    
                    <div class="inline-block bg-pink-100 text-pink-600 px-3 py-1 rounded-lg font-bold text-lg mb-4">
                        Rp <span id="modalPrice"></span>
                    </div>

                    <p class="text-gray-500 text-sm leading-relaxed mb-6" id="modalDescription">
                        Loading deskripsi...
                    </p>

                    <button onclick="closeModal()" class="w-full bg-pink-400 hover:bg-pink-500 text-white font-bold py-3 px-4 rounded-xl shadow-md transition transform hover:-translate-y-1">
                        Tutup 🌸
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi Buka Modal
    const modal = document.getElementById('detailModal');
    
    // Ambil semua tombol dengan class .btn-detail
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const url = this.getAttribute('data-url');

            // Fetch data dari server (AJAX)
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    // Isi data ke dalam Modal
                    document.getElementById('modalName').innerText = data.name;
                    document.getElementById('modalPrice').innerText = new Intl.NumberFormat('id-ID').format(data.price);
                    document.getElementById('modalDescription').innerText = data.description;
                    
                    // Set Gambar (Asumsi folder gambar ada di public/images/)
                    document.getElementById('modalImage').src = `/images/${data.image}`;

                    // Tampilkan Modal
                    modal.classList.remove('hidden');
                })
                .catch(error => console.error('Error:', error));
        });
    });

    // Fungsi Tutup Modal
    function closeModal() {
        modal.classList.add('hidden');
    }
</script>

@endsection