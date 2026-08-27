<x-customer-layout>
    <!-- Hero Section Apple Style -->
    <section class="relative bg-black text-white overflow-hidden pt-24 pb-32 animate-fade-in-up">
        <div class="absolute inset-0 bg-gradient-to-b from-black via-zinc-900 to-black z-0"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-bold tracking-tighter mb-4">
                iPhone 17 Pro Max
            </h1>
            <p class="text-xl md:text-2xl font-medium text-primary mb-8">Hello, Apple Intelligence.</p>
            <p class="text-lg md:text-xl text-gray-400 mb-10 max-w-2xl mx-auto font-light">Sewa perangkat paling canggih yang pernah ada. Desain titanium yang memukau. Performa tak tertandingi.</p>
            <div class="flex justify-center gap-4">
                <a href="#katalog" class="bg-primary text-white px-8 py-3 rounded-full font-medium hover:scale-105 transition-transform duration-300">Sewa Sekarang</a>
                <a href="#katalog" class="bg-white/10 backdrop-blur-md text-white px-8 py-3 rounded-full font-medium hover:bg-white/20 transition-colors duration-300">Lihat Model Lain</a>
            </div>
            
            <div class="mt-20 flex justify-center">
                <!-- Using a high-res image representing the new phone -->
                <img src="https://images.unsplash.com/photo-1696446701796-da61225697cc?q=80&w=1200" alt="iPhone Hero" class="w-full max-w-4xl rounded-[2.5rem] shadow-2xl border border-white/10 hover:scale-[1.02] transition-transform duration-700">
            </div>
        </div>
    </section>

    <div id="katalog" class="py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-in-up delay-100">
                <h2 class="text-4xl font-bold tracking-tight mb-4">Pilih iPhone Anda.</h2>
                <p class="text-xl text-gray-500">Harga sewa harian terbaik. Langsung dikirim.</p>
            </div>

            @if(session('success')) <div class="bg-green-100 text-green-700 p-4 mb-6 rounded-2xl text-center text-sm font-medium max-w-3xl mx-auto animate-fade-in-up">{{ session('success') }}</div> @endif
            @if(session('error')) <div class="bg-red-100 text-red-700 p-4 mb-6 rounded-2xl text-center text-sm font-medium max-w-3xl mx-auto animate-fade-in-up">{{ session('error') }}</div> @endif
            
            <!-- Date Picker Apple Style -->
            <div class="bg-white/70 backdrop-blur-xl border border-gray-200/50 rounded-[2rem] p-8 mb-16 max-w-4xl mx-auto shadow-sm animate-fade-in-up delay-200">
                <h3 class="font-semibold text-xl mb-6 text-center">Tentukan Tanggal Sewa</h3>
                <form action="{{ route('cart.dates') }}" method="POST" class="flex flex-col md:flex-row gap-6 items-end justify-center">
                    @csrf
                    <div class="w-full md:w-1/3">
                        <label class="block text-sm font-medium text-gray-500 mb-2">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ session('cart_start_date') }}" class="w-full bg-gray-50 border-0 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary transition-shadow" required>
                    </div>
                    <div class="w-full md:w-1/3">
                        <label class="block text-sm font-medium text-gray-500 mb-2">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ session('cart_end_date') }}" class="w-full bg-gray-50 border-0 rounded-xl px-4 py-3 focus:ring-2 focus:ring-primary transition-shadow" required>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-black text-white rounded-xl px-8 py-3 font-medium hover:bg-gray-800 transition-colors shadow-lg">Cek Ketersediaan</button>
                </form>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 animate-fade-in-up delay-300">
                @foreach($iphones as $iphone)
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden flex flex-col group hover:shadow-xl transition-all duration-500 hover:-translate-y-2">
                    <div class="aspect-[4/5] bg-[#f5f5f7] p-8 relative overflow-hidden flex items-center justify-center">
                        <img src="{{ $iphone->image ?? 'https://images.unsplash.com/photo-1603791440384-56cd371ee9a7?q=80&w=800' }}" alt="{{ $iphone->name }}" class="object-cover w-full h-full rounded-xl shadow-lg group-hover:scale-110 transition-transform duration-700">
                    </div>
                    <div class="p-8 flex flex-col flex-1 text-center">
                        <p class="text-primary text-sm font-semibold mb-2">{{ $iphone->color }}</p>
                        <a href="{{ route('iphone.show', $iphone->id) }}" class="font-bold text-2xl tracking-tight text-gray-900 mb-2">{{ $iphone->name }}</a>
                        <p class="text-gray-500 text-sm mb-6">{{ $iphone->storage }}</p>
                        <p class="text-xl font-medium text-gray-900 mb-8">Rp {{ number_format($iphone->price_per_day, 0, ',', '.') }}<span class="text-sm font-normal text-gray-500">/hari</span></p>
                        
                        <form action="{{ route('cart.add', $iphone->id) }}" method="POST" class="mt-auto">
                            @csrf
                            <button type="submit" class="w-full bg-primary text-white rounded-full py-3 font-semibold hover:bg-primary/90 hover:shadow-lg hover:shadow-primary/30 transition-all duration-300">
                                Sewa
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</x-customer-layout>