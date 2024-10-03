<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div>
            <flux:subheading>
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </flux:subheading>
        </div>

        @session('status')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ $value }}
            </div>
        @endsession

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="space-y-6">
                <flux:input name="email" label="{{ __('Email') }}" type="email" :value="old('email')" required autofocus autocomplete="username"/>

                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit">
                        {{ __('Email Password Reset Link') }}
                    </flux:button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
