<x-customer-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl tracking-tight text-foreground">Detail iPhone</h2>
    </x-slot>

    <div class="py-12 bg-[#f5f5f7] min-h-screen animate-fade-in-up">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-[2rem] border border-gray-100 bg-white shadow-sm overflow-hidden flex flex-col md:flex-row">
                <div class="md:w-1/2 bg-gradient-to-b from-[#f5f5f7] to-[#e5e5ea] relative flex items-center justify-center">
                    <img src="{{ $iphone->image ?? 'https://m.media-amazon.com/images/I/81Os1SDWpcL._AC_SL1500_.jpg' }}" alt="{{ $iphone->name }}" class="object-contain w-4/5 h-4/5 mix-blend-multiply drop-shadow-2xl mx-auto my-auto p-8 hover:scale-105 transition-transform duration-700">
                </div>
                <div class="p-8 md:w-1/2 flex flex-col">
                    <div class="inline-flex items-center rounded-full border px-2.5 py-0.5 text-xs font-semibold w-fit mb-4 {{ $iphone->status == 'available' ? 'bg-primary/10 text-primary border-primary/20' : 'bg-destructive/10 text-destructive border-destructive/20' }}">{{ strtoupper($iphone->status) }}</div>
                    
                    <h3 class="text-3xl font-bold tracking-tight">{{ $iphone->name }}</h3>
                    <div class="flex gap-2 mt-3 mb-6">
                        <span class="inline-flex items-center rounded-md border bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground">{{ $iphone->storage }}</span>
                        <span class="inline-flex items-center rounded-md border bg-secondary px-2.5 py-0.5 text-xs font-semibold text-secondary-foreground">{{ $iphone->color }}</span>
                    </div>
                    
                    <p class="text-muted-foreground mb-8 leading-relaxed">{{ $iphone->description }}</p>
                    
                    <h4 class="text-3xl font-bold tracking-tight text-primary mb-6">Rp {{ number_format($iphone->price_per_day, 0, ',', '.') }}<span class="text-sm font-normal text-muted-foreground">/hari</span></h4>
                    
                    <form action="{{ route('cart.add', $iphone->id) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="w-full inline-flex items-center justify-center rounded-md text-sm font-medium bg-primary text-primary-foreground shadow hover:bg-primary/90 h-12 px-8 text-base">
                            Tambah ke Keranjang
                        </button>
                    </form>
                </div>
            </div>

            <div class="mt-8 rounded-[2rem] border border-gray-100 bg-white shadow-sm p-8">
                <h4 class="text-2xl font-bold tracking-tight mb-6">Ulasan (Reviews)</h4>
                @if($iphone->reviews()->count() > 0)
                    <div class="space-y-6">
                    @foreach($iphone->reviews as $review)
                        <div class="border-b pb-6 last:border-0 last:pb-0">
                            <div class="flex items-center justify-between mb-2">
                                <p class="font-semibold">{{ $review->user->name }}</p>
                                <div class="flex items-center">
                                    <span class="text-primary font-bold mr-1">{{ $review->rating }}</span><span class="text-muted-foreground text-sm">/ 5</span>
                                </div>
                            </div>
                            <p class="text-muted-foreground">{{ $review->comment }}</p>
                            <p class="text-xs text-muted-foreground mt-2">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    @endforeach
                    </div>
                @else
                    <p class="text-muted-foreground italic">Belum ada ulasan untuk iPhone ini.</p>
                @endif
            </div>
        </div>
    </div>
</x-customer-layout>