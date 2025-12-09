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