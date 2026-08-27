<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Sewa iPhone') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#f5f5f7]">
    <!-- Sticky Glass Header -->
    <header class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-md border-b border-gray-200/50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-14">
                <div class="flex items-center gap-8">
                    <a href="{{ route('home') }}" class="font-semibold text-xl tracking-tight flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></svg>
                        <span class="hidden sm:inline">Sewa iPhone</span>
                    </a>
                    
                    <nav class="hidden md:flex gap-6 text-sm font-medium text-gray-600">
                        <a href="{{ route('home') }}" class="hover:text-black transition-colors {{ request()->routeIs('home') ? 'text-black' : '' }}">Katalog</a>
                        @auth
                            @if(Auth::user()->role === 'customer')
                                <a href="{{ route('customer.bookings.index') }}" class="hover:text-black transition-colors {{ request()->routeIs('customer.bookings.*') ? 'text-black' : '' }}">Pesanan Saya</a>
                            @endif
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary text-primary transition-colors">Admin Panel</a>
                            @endif
                        @endauth
                    </nav>
                </div>

                <div class="flex items-center gap-4">
                    <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-black transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"/><path d="M3 6h18"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                        @if(count(session('cart', [])) > 0)
                            <span class="absolute -top-1.5 -right-2 bg-primary text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">{{ count(session('cart', [])) }}</span>
                        @endif
                    </a>

                    @auth
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open" class="flex items-center gap-2 text-sm text-gray-600 hover:text-black transition-colors">
                                <span>{{ Auth::user()->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </button>
                            <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white/90 backdrop-blur-md rounded-xl shadow-lg py-2 border border-gray-100 hidden" :class="{'hidden': !open}">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profil</a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Keluar</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:text-black transition-colors">Log In</a>
                        <a href="{{ route('register') }}" class="text-sm bg-black text-white px-4 py-1.5 rounded-full hover:bg-gray-800 transition-colors">Daftar</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <main class="pt-14 min-h-screen">
        {{ $slot }}
    </main>

    <footer class="bg-white border-t border-gray-200 mt-20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-500 text-sm">
            <p>&copy; {{ date('Y') }} Sewa iPhone Apple Premium. Hak Cipta Dilindungi.</p>
        </div>
    </footer>
</body>
</html>