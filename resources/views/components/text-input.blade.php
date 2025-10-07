@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-none bg-white/10 text-white placeholder-gray-300 focus:ring-2 focus:ring-indigo-400 rounded-lg w-full py-2 px-4 transition duration-300'
]) !!}>