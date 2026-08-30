<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center bg-red-600 text-white rounded-xl px-6 py-3 font-semibold hover:bg-red-700 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2']) }}>
    {{ $slot }}
</button>