<button {{ $attributes->merge(['type' => 'submit', 'class' => 'bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold py-2 px-6 rounded-xl hover:from-purple-600 hover:to-indigo-500 transition duration-300 shadow-lg focus:ring-2 focus:ring-purple-400 focus:outline-none']) }}>
    {{ $slot }}
</button>
