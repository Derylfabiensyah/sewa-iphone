<x-guest-layout>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold tracking-tight text-gray-900">Selamat Datang Kembali</h2>
        <p class="text-sm text-gray-500 mt-2">Silakan masuk ke akun Anda untuk melanjutkan.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow" placeholder="nama@email.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Password -->
        <div>
            <div class="flex justify-between items-center mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                @if (Route::has('password.request'))
                    <a class="text-xs font-semibold text-primary hover:text-primary/80 transition-colors" href="{{ route('password.request') }}">
                        Lupa password?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" required autocomplete="current-password" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-primary transition-shadow" placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 text-primary bg-gray-50 border-gray-300 rounded focus:ring-primary">
            <label for="remember_me" class="ml-2 block text-sm text-gray-600">Ingat Saya</label>
        </div>

        <div class="pt-2">
            <button type="submit" class="w-full bg-black text-white rounded-xl py-3 font-semibold hover:bg-gray-800 hover:shadow-lg transition-all duration-300">
                Log In
            </button>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="font-semibold text-primary hover:underline">Daftar sekarang</a>
        </p>
    </form>
</x-guest-layout>