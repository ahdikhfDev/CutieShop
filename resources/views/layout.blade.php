<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Cutie Shop 🌸</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Quicksand', sans-serif; }
    </style>
</head>
<body class="bg-pink-50 text-gray-700">

    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl font-bold text-center text-pink-500 mb-2">🎀 My Dream Shop 🎀</h1>
        <p class="text-center text-pink-300 mb-8">Koleksi Barang-Barang Lucu</p>
        
        @if ($message = Session::get('success'))
            <div class="bg-pink-100 border-l-4 border-pink-500 text-pink-700 p-4 mb-6 rounded-r-lg shadow-sm" role="alert">
                <p class="font-bold">Yay!</p>
                <p>{{ $message }}</p>
            </div>
        @endif

        @yield('content')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Script untuk tombol delete
        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const formId = this.getAttribute('data-id');
                const form = document.getElementById(`delete-form-${formId}`);
                const parentForm = this.closest('form'); 

                Swal.fire({
                    title: 'Yakin mau hapus? 🥺',
                    text: "Data yang dihapus nggak bisa balik lagi lho!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#f472b6', 
                    cancelButtonColor: '#d1d5db', 
                    confirmButtonText: 'Ya, Hapus Aja!',
                    cancelButtonText: 'Gak Jadi',
                    background: '#fff1f2', 
                    color: '#be185d', 
                    borderRadius: '20px'
                }).then((result) => {
                    if (result.isConfirmed) {
                        if(parentForm) parentForm.submit(); 
                        else if(form) form.submit();
                    }
                })
            });
        });
    </script>
</body>
</html>
</body>
</html>