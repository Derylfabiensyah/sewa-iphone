<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up"><h3 class="text-gray-500">Total iPhones</h3><p class="text-2xl font-bold">{{ $stats['total_iphones'] }}</p></div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up"><h3 class="text-gray-500">Total Bookings</h3><p class="text-2xl font-bold">{{ $stats['total_bookings'] }}</p></div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up"><h3 class="text-gray-500">Total Customers</h3><p class="text-2xl font-bold">{{ $stats['total_customers'] }}</p></div>
            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up"><h3 class="text-gray-500">Pending Payments</h3><p class="text-2xl font-bold">{{ $stats['pending_payments'] }}</p></div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6 grid grid-cols-3 gap-6">
            <a href="{{ route('admin.users.index') }}" class="bg-purple-600 text-white text-center py-4 rounded shadow block text-xl font-bold">Kelola Users</a>
            <a href="{{ route('admin.iphones.index') }}" class="bg-blue-600 text-white text-center py-4 rounded shadow block text-xl font-bold">Kelola iPhone</a>
            <a href="{{ route('admin.bookings.index') }}" class="bg-green-600 text-white text-center py-4 rounded shadow block text-xl font-bold">Kelola Pesanan</a>
        </div>
    </div>
</x-admin-layout>