<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex justify-center items-center bg-white border border-gray-200 text-gray-700 rounded-xl px-6 py-3 font-semibold hover:bg-gray-50 hover:shadow-md transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 disabled:opacity-25']) }}>
    {{ $slot }}
</button>