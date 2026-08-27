<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Tambah User</h2></x-slot>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded shadow">
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block">Nama</label>
                    <input type="text" name="name" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" name="email" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">Password</label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">Role</label>
                    <select name="role" class="w-full border-gray-300 rounded" required>
                        <option value="customer">Customer</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Simpan</button>
            </form>
        </div>
    </div>
</x-app-layout>