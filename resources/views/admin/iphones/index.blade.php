<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola iPhones</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up">
            <a href="{{ route('admin.iphones.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">+ Tambah iPhone</a>
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr><th>Nama</th><th>Storage/Color</th><th>Harga/Hari</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($iphones as $iphone)
                    <tr>
                        <td class="border-b py-2">{{ $iphone->name }}</td>
                        <td class="border-b py-2">{{ $iphone->storage }} - {{ $iphone->color }}</td>
                        <td class="border-b py-2">Rp {{ number_format($iphone->price_per_day) }}</td>
                        <td class="border-b py-2">{{ $iphone->status }}</td>
                        <td class="border-b py-2">
                            <a href="{{ route('admin.iphones.edit', $iphone->id) }}" class="text-blue-600 mr-2">Edit</a><form action="{{ route('admin.iphones.destroy', $iphone->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus?');">@csrf @method('DELETE') <button class="text-red-600">Hapus</button></form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>