<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="space-y-6">
                <flux:input name="email" label="{{ __('Email') }}" type="email" :value="old('email')" required autofocus autocomplete="username"/>

                <flux:input name="password" type="password" label="{{ __('Password') }}" required autocomplete="current-password" viewable/>

                <flux:checkbox name="remember" label="{{ __('Remember me') }}" />

                <div class="flex items-center justify-end">
                    @if (Route::has('password.request'))
                        <flux:link class="text-sm" href="{{ route('password.request') }}" variant="subtle">{{ __('Forgot your password?') }}</flux:link>
                    @endif

                    <flux:button variant="primary" type="submit" class="ml-4">
                        {{ __('Log in') }}
                    </flux:button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
