<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-5 py-3 text-white bg-primary border border-transparent rounded-md font-semibold uppercase tracking-widest hover:bg-primary-1 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
