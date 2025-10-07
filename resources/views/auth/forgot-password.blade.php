<x-guest-layout>
    <div class="mb-4 text-sm text-gray-300">
        {{ __('Forgot your password? No worries. Just enter your email below.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-6">
            <x-primary-button>
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
            {{ __('Back to Login') }}
        </a>
        <span class="text-gray-400 mx-2">|</span>
        <a href="{{ route('register') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
            {{ __('Create New Account') }}
        </a>
    </div>
</x-guest-layout>
