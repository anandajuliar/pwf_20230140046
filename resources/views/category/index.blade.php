<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Category List</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <!-- Tombol Add Category sesuai gambar di soal UCP -->
                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-4">Manage your category</p>
                    <a href="{{ route('category.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded inline-block">+ Add Category</a>
                </div>

                <!-- Tabel Category sesuai struktur di soal UCP -->
                <table class="w-full mt-4 border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">NAME</th>
                            <th class="border p-2 text-center">TOTAL PRODUCT</th>
                            <th class="border p-2 text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td class="border p-2">{{ $category->name }}</td>
                            
                            <!-- Kolom ini otomatis mengambil jumlah produk dari relasi database -->
                            <td class="border p-2 text-center">{{ $category->products_count }}</td>
                            
                            <td class="border p-2 text-center">
                                <!-- Tombol Edit -->
                                <a href="{{ route('category.edit', $category->id) }}" class="text-blue-500 mx-1">Edit</a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('category.destroy', $category->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 mx-1" onclick="return confirm('Yakin ingin menghapus kategori ini?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
        </div>
    </div>
</x-app-layout>