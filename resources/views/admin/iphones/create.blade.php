<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah iPhone</h2></x-slot>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up">
            <form action="{{ route('admin.iphones.store') }}" method="POST">
                @csrf
                <div class="mb-4"><label class="block">Nama iPhone</label><input type="text" name="name" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4"><label class="block">Storage (contob: 128GB)</label><input type="text" name="storage" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4"><label class="block">Warna</label><input type="text" name="color" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4"><label class="block">Harga per Hari (Rp)</label><input type="number" name="price_per_day" class="w-full border-gray-300 rounded" required></div>
                <div class="mb-4"><label class="block">Deskripsi Singkat</label><textarea name="description" class="w-full border-gray-300 rounded"></textarea></div>
                <div class="mb-4"><label class="block">Status</label><select name="status" class="w-full border-gray-300 rounded" required><option value="available">Tersedia</option><option value="maintenance">Maintenance</option></select></div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-admin-layout>