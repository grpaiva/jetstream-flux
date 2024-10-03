<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="space-y-6">
                <flux:input name="email" label="{{ __('Email') }}" type="email" :value="old('email', $request->email)" required autofocus autocomplete="username"/>

                <flux:input name="password" type="password" label="{{ __('Password') }}" required autocomplete="new-password" viewable/>

                <flux:input name="password_confirmation" type="password" label="{{ __('Confirm Password') }}" required autocomplete="new-password" viewable/>

                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit">
                        {{ __('Reset Password') }}
                    </flux:button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
