<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4" x-data="{ showPassword: false }">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" x-bind:type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
            <label class="inline-flex items-center mt-2 cursor-pointer">
                <input type="checkbox" x-model="showPassword" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                <span class="ms-2 text-sm text-gray-600">{{ __('Show password') }}</span>
            </label>
        </div>

        <div class="mt-6 space-y-4">
            <div class="flex flex-col gap-3 text-sm">
                <a href="{{ route('register') }}" class="font-medium text-red-600 hover:text-red-700">{{ __('Don\'t have an account? Register') }}</a>
            </div>
            <button type="submit" class="w-full py-3 px-6 rounded-lg font-semibold text-white bg-red-600 hover:bg-red-700 focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-colors">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
