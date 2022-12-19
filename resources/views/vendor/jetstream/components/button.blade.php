<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-primary-400 text-white border border-transparent font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-300 hover:text-gray-800 active:bg-primary-600 focus:outline-none focus:bg-primary-600 focus:ring focus:bg-primary-600 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
