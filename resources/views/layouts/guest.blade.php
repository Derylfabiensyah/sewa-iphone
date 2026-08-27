<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Sewa iPhone') }} - Masuk</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-[#f5f5f7] selection:bg-primary/30 selection:text-primary">
    <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 relative">
        <!-- Abstract Background Decoration -->
        <div class="fixed top-0 left-0 w-full h-full overflow-hidden z-0 pointer-events-none opacity-40">
            <div class="absolute -top-[20%] -left-[10%] w-[50%] h-[50%] rounded-full bg-primary/20 blur-[120px]"></div>
            <div class="absolute top-[60%] -right-[10%] w-[50%] h-[50%] rounded-full bg-blue-400/10 blur-[120px]"></div>
        </div>

        <div class="z-10 animate-fade-in-up">
            <a href="/" class="flex flex-col items-center gap-3 mb-8 group">
                <div class="bg-white p-3 rounded-2xl shadow-sm border border-gray-100 group-hover:scale-105 transition-transform duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 20.94c1.5 0 2.75 1.06 4 1.06 3 0 6-8 6-12.22A4.91 4.91 0 0 0 17 5c-2.22 0-4 1.44-5 2-1-.56-2.78-2-5-2a4.9 4.9 0 0 0-5 4.78C2 14 5 22 8 22c1.25 0 2.5-1.06 4-1.06Z"/><path d="M10 2c1 .5 2 2 2 5"/></svg>
                </div>
                <span class="text-2xl font-bold tracking-tight text-gray-900">Sewa iPhone</span>
            </a>
        </div>

        <div class="w-full sm:max-w-md px-8 py-10 bg-white/70 backdrop-blur-xl shadow-2xl border border-white/50 rounded-[2rem] z-10 animate-fade-in-up delay-100">
            {{ $slot }}
        </div>
        
        <div class="mt-8 z-10 animate-fade-in-up delay-200">
            <a href="/" class="text-sm font-medium text-gray-500 hover:text-black transition-colors flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                Kembali ke Katalog
            </a>
        </div>
    </div>
</body>
</html>