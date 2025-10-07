<x-guest-layout>
    <div class="mb-4 text-sm text-gray-300">
        {{ __('Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('dashboard') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
            {{ __('Back to Dashboard') }}
        </a>
        <span class="text-gray-400 mx-2">|</span>
        <a href="{{ route('login') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
            {{ __('Login Page') }}
        </a>
    </div>
</x-guest-layout>
