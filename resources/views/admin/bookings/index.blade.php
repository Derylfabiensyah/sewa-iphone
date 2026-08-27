<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Kelola Pesanan</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr><th>Order ID</th><th>Customer</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="border-b py-2">#{{ $booking->id }}</td>
                        <td class="border-b py-2">{{ $booking->user->name }}</td>
                        <td class="border-b py-2">{{ $booking->start_date }} s/d {{ $booking->end_date }}</td>
                        <td class="border-b py-2">{{ $booking->status }}</td>
                        <td class="border-b py-2">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="text-blue-600">Detail</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>