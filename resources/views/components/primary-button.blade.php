<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center bg-black text-white rounded-xl px-6 py-3 font-semibold hover:bg-gray-800 hover:shadow-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2']) }}>
    {{ $slot }}
</button>