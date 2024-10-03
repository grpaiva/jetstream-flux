<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <flux:subheading>
            {{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </flux:subheading>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="space-y-6">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <flux:button variant="primary" type="submit" class="w-full">
                    {{ __('Resend Verification Email') }}
                </flux:button>
            </form>
        </div>

        <div class="mt-4 flex items-center justify-end">

            <div class="text-sm space-x-3">
                <flux:link href="{{ route('profile.show') }}">
                    {{ __('Edit Profile') }}
                </flux:link>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit">
                        <flux:link>{{ __('Log Out') }}</flux:link>
                    </button>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
