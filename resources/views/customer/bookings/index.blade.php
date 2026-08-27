<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Pesanan Saya</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div> @endif

            @foreach($bookings as $booking)
            <div class="bg-white rounded shadow p-6 mb-6">
                <div class="flex justify-between border-b pb-4 mb-4">
                    <div>
                        <p class="text-gray-500 text-sm">Order #{{ $booking->id }}</p>
                        <p><strong>Tanggal:</strong> {{ $booking->start_date }} s/d {{ $booking->end_date }}</p>
                        <p><strong>Total:</strong> Rp {{ number_format($booking->total_price) }}</p>
                    </div>
                    <div>
                        <span class="px-3 py-1 bg-gray-200 rounded uppercase text-sm font-bold">{{ $booking->status }}</span>
                    </div>
                </div>

                <ul class="mb-4">
                    @foreach($booking->details as $detail)
                        <li>- {{ $detail->iphone->name }} (Rp {{ number_format($detail->subtotal) }})</li>
                    @endforeach
                </ul>

                @if($booking->status === 'waiting_payment')
                <form action="{{ route('customer.bookings.payment', $booking->id) }}" method="POST" enctype="multipart/form-data" class="bg-gray-50 p-4 rounded mt-4 border">
                    @csrf
                    <label class="block font-bold mb-2">Upload Bukti Transfer</label>
                    <input type="file" name="proof_of_payment" class="mb-2" required>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Upload</button>
                </form>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</x-customer-layout>