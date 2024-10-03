<x-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl">
            <flux:heading>
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        {{ __('Finish enabling two factor authentication.') }}
                    @else
                        {{ __('You have enabled two factor authentication.') }}
                    @endif
                @else
                    {{ __('You have not enabled two factor authentication.') }}
                @endif
            </flux:heading>

            <flux:subheading>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </flux:subheading>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl">
                    <flux:subheading>
                        @if ($showingConfirmation)
                            {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                        @else
                            {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                        @endif
                    </flux:subheading>
                </div>

                <div class="mt-4 p-2 inline-block bg-white">
                    {!! $this->user->twoFactorQrCodeSvg() !!}
                </div>

                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                    </p>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <flux:field>
                            <flux:label>{{ __('Code') }}</flux:label>

                            <flux:input
                                name="code"
                                inputmode="numeric"
                                autofocus
                                autocomplete="one-time-code"
                                wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication" />

                            <flux:error name="code" />
                        </flux:field>
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 dark:bg-zinc-900 dark:text-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <flux:button variant="primary" type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </flux:button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <flux:button class="me-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </flux:button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <flux:button variant="primary" class="me-3">
                            {{ __('Confirm') }}
                        </flux:button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <flux:button variant="primary" class="me-3">
                            {{ __('Show Recovery Codes') }}
                        </flux:button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <flux:button variant="outline">
                            {{ __('Cancel') }}
                        </flux:button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <flux:button variant="danger">
                            {{ __('Disable') }}
                        </flux:button>
                    </x-confirms-password>
                @endif
            @endif
        </div>
    </x-slot>
</x-action-section>