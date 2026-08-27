<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail iPhone: {{ $iphone->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded shadow p-8">
                <h3 class="text-3xl font-bold mb-4">{{ $iphone->name }}</h3>
                <p><strong>Storage:</strong> {{ $iphone->storage }}</p>
                <p><strong>Warna:</strong> {{ $iphone->color }}</p>
                <p><strong>Status:</strong> {{ $iphone->status }}</p>
                <p class="mt-4 text-gray-700">{{ $iphone->description }}</p>
                
                <h4 class="text-2xl font-bold text-blue-600 mt-6 mb-4">Rp {{ number_format($iphone->price_per_day, 0, ',', '.') }} / hari</h4>
                
                <form action="{{ route('cart.add', $iphone->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 text-lg font-bold rounded">Tambah ke Keranjang</button>
                </form>

                <h4 class="text-xl font-bold mt-12 border-b pb-2">Ulasan (Reviews)</h4>
                @if($iphone->reviews()->count() > 0)
                    @foreach($iphone->reviews as $review)
                        <div class="mt-4 border p-4 rounded bg-gray-50">
                            <p class="font-bold">{{ $review->user->name }} - {{ $review->rating }}/5</p>
                            <p class="mt-2 text-gray-600">{{ $review->comment }}</p>
                            <p class="text-xs text-gray-400 mt-2">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                @else
                    <p class="mt-4 text-gray-500">Belum ada ulasan untuk iPhone ini.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>