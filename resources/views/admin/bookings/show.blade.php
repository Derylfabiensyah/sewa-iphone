<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pesanan #{{ $booking->id }}</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up">
            <h3 class="font-bold text-lg mb-4">Informasi Penyewa</h3>
            <p><strong>Nama:</strong> {{ $booking->user->name }}</p>
            <p><strong>Tanggal Sewa:</strong> {{ $booking->start_date }} s/d {{ $booking->end_date }}</p>
            <p><strong>Status Pesanan:</strong> {{ $booking->status }}</p>
            
            <h3 class="font-bold text-lg mt-6 mb-2">Barang Disewa</h3>
            <ul>
                @foreach($booking->details as $detail)
                    <li>- {{ $detail->iphone->name }} (Rp {{ number_format($detail->subtotal) }})</li>
                @endforeach
            </ul>
        </div>

        <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm animate-fade-in-up">
            <h3 class="font-bold text-lg mb-4">Pembayaran & Aksi</h3>
            <p><strong>Status Pembayaran:</strong> {{ $booking->payment->status ?? 'Belum ada' }}</p>
            @if($booking->payment && $booking->payment->proof_of_payment)
                <p><strong>Bukti Transfer:</strong> <a href="{{ asset('storage/'.$booking->payment->proof_of_payment) }}" target="_blank" class="text-blue-600 underline">Lihat Foto</a></p>
                
                @if($booking->payment->status == 'pending')
                <form action="{{ route('admin.bookings.verify', $booking->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button class="bg-green-600 text-white px-4 py-2 rounded">Verifikasi Pembayaran</button>
                    </form>
                    <form action="{{ route('admin.bookings.reject', $booking->id) }}" method="POST" class="mt-2">
                        @csrf
                        <button class="bg-red-600 text-white px-4 py-2 rounded">Tolak Pembayaran</button>
                    </form>
                @endif
            @endif

            @if($booking->status == 'confirmed')
                <form action="{{ route('admin.bookings.active', $booking->id) }}" method="POST" class="mt-4">
                    @csrf
                    <button class="bg-blue-600 text-white px-4 py-2 rounded">Tandai Sedang Disewa (Active)</button>
                </form>
            @endif

            @if($booking->status == 'active')
                <h4 class="font-bold mt-6 mb-2 text-red-600">Proses Pengembalian</h4>
                <form action="{{ route('admin.bookings.return', $booking->id) }}" method="POST">
                    @csrf
                    @foreach($booking->details as $detail)
                        <div class="mb-4 border p-4 rounded">
                            <p class="font-bold">{{ $detail->iphone->name }}</p>
                            <label class="block mt-2">Kondisi</label>
                            <input type="text" name="returns[{{ $detail->id }}][condition]" class="border-gray-300 rounded w-full" required>
                            
                            <label class="block mt-2">Denda (Rp)</label>
                            <input type="number" name="returns[{{ $detail->id }}][penalty_fee]" value="0" class="border-gray-300 rounded w-full" required>
                            
                            <label class="block mt-2">Catatan Denda</label>
                            <input type="text" name="returns[{{ $detail->id }}][penalty_notes]" class="border-gray-300 rounded w-full">
                        </div>
                    @endforeach
                    <button class="bg-red-600 text-white px-4 py-2 rounded">Proses Pengembalian (Selesai)</button>
                </form>
            @endif
        </div>
    </div>
</x-admin-layout>