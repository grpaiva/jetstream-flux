<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <flux:subheading>
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </flux:subheading>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="space-y-6">
                <flux:input name="password" label="{{ __('Password') }}" type="password" required autofocus autocomplete="current-password"/>

                <div class="flex justify-end">
                    <flux:button variant="primary" type="submit" class="ms-4">
                        {{ __('Confirm') }}
                    </flux:button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
