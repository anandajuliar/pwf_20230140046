<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Produk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p><strong>Nama:</strong> {{ $product->name }}</p>
                <p><strong>Quantity:</strong> {{ $product->qty }}</p>
                <p><strong>Harga:</strong> Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                
                <div class="mt-6 flex items-center gap-2">
                    <a href="{{ route('product.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-150">
                        Kembali
                    </a>
                    
                    @can('update', $product)
                        <x-edit-button :url="route('product.edit', $product->id)" />
                    @endcan

                    @can('delete', $product)
                        <x-delete-button :url="route('product.destroy', $product->id)" />
                    @endcan
                </div>

            </div>
        </div>
    </div>
</x-app-layout>