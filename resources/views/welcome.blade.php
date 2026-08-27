<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Katalog Sewa iPhone') }}
            </h2>
            <a href="{{ route('cart.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded">
                Keranjang ({{ count(session('cart', [])) }})
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-4 rounded">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">{{ session('error') }}</div> @endif
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                <form action="{{ route('cart.dates') }}" method="POST" class="flex gap-4 items-end">
                    @csrf
                    <div>
                        <label class="block text-sm">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ session('cart_start_date') }}" class="border-gray-300 rounded" required>
                    </div>
                    <div>
                        <label class="block text-sm">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ session('cart_end_date') }}" class="border-gray-300 rounded" required>
                    </div>
                    <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded">Set Tanggal Sewa</button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($iphones as $iphone)
                <div class="bg-white rounded shadow p-4">
                    <h3 class="text-xl font-bold"><a href="{{ route('iphone.show', $iphone->id) }}" class="text-blue-600 hover:underline">{{ $iphone->name }}</a> ({{ $iphone->storage }}, {{ $iphone->color }})</h3>
                    <p class="text-gray-600 mt-2">{{ $iphone->description }}</p>
                    <p class="text-blue-600 font-bold text-lg mt-2">Rp {{ number_format($iphone->price_per_day, 0, ',', '.') }} / hari</p>
                    
                    <form action="{{ route('cart.add', $iphone->id) }}" method="POST" class="mt-4">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">Tambah ke Keranjang</button>
                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>