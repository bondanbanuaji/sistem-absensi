<x-guest-layout>
    <div class="mb-4 text-sm text-gray-300">
        {{ __('Before continuing, please verify your email address by clicking the link we sent to your email.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm text-green-400">
            {{ __('A new verification link has been sent!') }}
        </div>
    @endif

    <div class="flex items-center justify-between mt-6">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <x-primary-button>
                {{ __('Resend Email') }}
            </x-primary-button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-indigo-400 hover:text-indigo-300">
                {{ __('Logout') }}
            </button>
        </form>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-indigo-400 hover:text-indigo-300">
            {{ __('Back to Login') }}
        </a>
    </div>
</x-guest-layout>
