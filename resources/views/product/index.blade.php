<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Data Produk</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                @can('export-product') 
                    <a href="{{ route('product.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Produk</a>
                @endcan
                <table class="w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Nama</th>
                            <th class="border p-2">Qty</th>
                            <th class="border p-2">Harga</th>
                            <th class="border p-2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $p)
                        <tr>
                            <td class="border p-2">{{ $p->name }}</td>
                            <td class="border p-2">{{ $p->qty }}</td>
                            <td class="border p-2">Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                            <td class="border p-2 text-center">
                                
                                <a href="{{ route('product.show', $p->id) }}" class="text-green-500 mx-1">View</a>
                                
                                @can('update', $p)
                                    <a href="{{ route('product.edit', $p->id) }}" class="text-blue-500 mx-1">Edit</a>
                                @endcan

                                @can('delete', $p)
                                    <form action="{{ route('product.destroy', $p->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 mx-1" onclick="return confirm('Yakin ingin menghapus?')">Delete</button>
                                    </form>
                                @endcan

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>