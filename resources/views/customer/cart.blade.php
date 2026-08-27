<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Keranjang Sewa</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 rounded shadow">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">{{ session('error') }}</div> @endif
            
            <p><strong>Tanggal Sewa:</strong> {{ $start_date ?? '-' }} s/d {{ $end_date ?? '-' }}</p>

            <table class="w-full mt-6 text-left border-collapse">
                <thead>
                    <tr>
                        <th class="border-b py-2">Item</th>
                        <th class="border-b py-2">Harga/Hari</th>
                        <th class="border-b py-2">Subtotal</th>
                        <th class="border-b py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['subtotal']; @endphp
                        <tr>
                            <td class="border-b py-2">{{ $item['name'] }}</td>
                            <td class="border-b py-2">Rp {{ number_format($item['price']) }}</td>
                            <td class="border-b py-2">Rp {{ number_format($item['subtotal']) }}</td>
                            <td class="border-b py-2">
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button class="text-red-600">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-6 flex justify-between items-center">
                <h3 class="text-xl font-bold">Total: Rp {{ number_format($total) }}</h3>
                <form action="{{ route('customer.checkout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded">Checkout</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>