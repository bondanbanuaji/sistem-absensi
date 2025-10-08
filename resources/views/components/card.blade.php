<div {{ $attributes->merge(['class' => 'bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 transition hover:shadow-lg']) }}>
    @if (isset($title))
        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-4">{{ $title }}</h3>
    @endif
    {{ $slot }}
</div>
