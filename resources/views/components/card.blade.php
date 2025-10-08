@props(['title' => null, 'class' => ''])

<div {{ $attributes->merge(['class' => 'p-6 bg-white dark:bg-gray-800 shadow sm:rounded-lg ' . $class]) }}>
    @if($title)
        <h3 class="text-lg font-semibold">{{ $title }}</h3>
    @endif

    <div class="mt-2">
        {{ $slot }}
    </div>
</div>