<x-admin-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit User</h2></x-slot>
    <div class="py-12 max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block">Nama</label>
                    <input type="text" name="name" value="{{ $user->name }}" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">Email</label>
                    <input type="email" name="email" value="{{ $user->email }}" class="w-full border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label class="block">Password (Kosongkan jika tidak ingin ganti)</label>
                    <input type="password" name="password" class="w-full border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label class="block">Role</label>
                    <select name="role" class="w-full border-gray-300 rounded" required>
                        <option value="customer" {{ $user->role == 'customer' ? 'selected' : '' }}>Customer</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Update</button>
            </form>
        </div>
    </div>
</x-admin-layout>