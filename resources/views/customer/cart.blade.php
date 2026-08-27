<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl tracking-tight text-foreground">Keranjang Sewa</h2>
    </x-slot>

    <div class="py-12 bg-[#f5f5f7] min-h-screen animate-fade-in-up">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-md border border-green-200 text-sm font-medium">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-destructive/10 text-destructive p-4 mb-6 rounded-md border border-destructive/20 text-sm font-medium">{{ session('error') }}</div> @endif
            
            <div class="rounded-[2rem] border border-gray-100 bg-white shadow-sm overflow-hidden">
                <div class="p-6 border-b bg-muted/20">
                    <h3 class="font-semibold text-lg">Periode Sewa</h3>
                    <p class="text-sm text-muted-foreground mt-1">{{ $start_date ? \Carbon\Carbon::parse($start_date)->format('d M Y') : '-' }} s/d {{ $end_date ? \Carbon\Carbon::parse($end_date)->format('d M Y') : '-' }}</p>
                </div>

                <div class="p-0 overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="border-b bg-muted/50 text-muted-foreground">
                            <tr>
                                <th class="h-12 px-4 text-left align-middle font-medium">Item</th>
                                <th class="h-12 px-4 text-left align-middle font-medium">Harga/Hari</th>
                                <th class="h-12 px-4 text-left align-middle font-medium">Subtotal</th>
                                <th class="h-12 px-4 text-right align-middle font-medium">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total = 0; @endphp
                            @forelse($cart as $id => $item)
                                @php $total += $item['subtotal']; @endphp
                                <tr class="border-b transition-colors hover:bg-muted/50">
                                    <td class="p-4 align-middle font-medium">{{ $item['name'] }}</td>
                                    <td class="p-4 align-middle text-muted-foreground">Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                                    <td class="p-4 align-middle">Rp {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                                    <td class="p-4 align-middle text-right">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                                            @csrf
                                            <button class="inline-flex items-center justify-center rounded-md text-sm font-medium text-destructive hover:text-destructive/80 h-9 px-4 py-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="p-8 text-center text-muted-foreground">Keranjang masih kosong.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-6 bg-muted/20 flex flex-col md:flex-row justify-between items-center gap-4 border-t">
                    <div class="text-2xl font-bold tracking-tight">Total: <span class="text-primary">Rp {{ number_format($total, 0, ',', '.') }}</span></div>
                    <form action="{{ route('customer.checkout') }}" method="POST" class="w-full md:w-auto">
                        @csrf
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground shadow hover:bg-primary/90 h-10 px-8" {{ empty($cart) ? 'disabled' : '' }}>
                            Checkout Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-customer-layout>