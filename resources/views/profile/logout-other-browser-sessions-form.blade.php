<x-action-section>
    <x-slot name="title">
        {{ __('Browser Sessions') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Manage and log out your active sessions on other browsers and devices.') }}
    </x-slot>

    <x-slot name="content">

        <div class="max-w-xl">
            <flux:subheading>
                {{ __('If necessary, you may log out of all of your other browser sessions across all of your devices. Some of your recent sessions are listed below; however, this list may not be exhaustive. If you feel your account has been compromised, you should also update your password.') }}
            </flux:subheading>
        </div>

        @if (count($this->sessions) > 0)
            <div class="mt-5 space-y-6">
                <!-- Other Browser Sessions -->
                @foreach ($this->sessions as $session)
                    <div class="flex items-center">
                        <div>
                            @if ($session->agent->isDesktop())
                                <flux:icon.computer-desktop class="w-8 h-8 text-gray-500"/>
                            @else
                                <flux:icon.device-phone-mobile class="w-8 h-8 text-gray-500"/>
                            @endif
                        </div>

                        <div class="ms-3">
                            <flux:label>
                                {{ $session->agent->platform() ? $session->agent->platform() : __('Unknown') }} - {{ $session->agent->browser() ? $session->agent->browser() : __('Unknown') }}
                            </flux:label>

                            <div>
                                <div class="text-xs text-gray-500">
                                    {{ $session->ip_address }},

                                    @if ($session->is_current_device)
                                        <span class="text-green-500 font-semibold">{{ __('This device') }}</span>
                                    @else
                                        {{ __('Last active') }} {{ $session->last_active }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="flex items-center mt-5">
            <flux:button variant="primary" wire:click="confirmLogout">
                {{ __('Log Out Other Browser Sessions') }}
            </flux:button>

            <x-action-message class="ms-3" on="loggedOut">
                {{ __('Done.') }}
            </x-action-message>
        </div>

        <!-- Log Out Other Devices Confirmation Modal -->
        <flux:modal wire:model.live="confirmingLogout" class="space-y-6">
            <div>
                <flux:heading>{{ __('Log Out Other Browser Sessions') }}</flux:heading>
                <flux:subheading>{{ __('Please enter your password to confirm you would like to log out of your other browser sessions across all of your devices.') }}</flux:subheading>
            </div>

            <div class="mt-4" x-data="{}" x-on:confirming-logout-other-browser-sessions.window="setTimeout(() => $refs.password.focus(), 250)">
                <flux:field>
                    <flux:input type="password" class="mt-1 block w-3/4" placeholder="{{ __('Password') }}"    autocomplete="current-password"
                                x-ref="password"
                                wire:model="password"
                                wire:keydown.enter="logoutOtherBrowserSessions" />
                    <flux:error name="password" class="mt-2" />
                </flux:field>

            </div>

            <div>
                <flux:button wire:click="$toggle('confirmingLogout')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </flux:button>

                <flux:button variant="primary" class="ms-3" dusk="confirm-password-button" wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled">
                    {{ __('Log Out Other Browser Sessions') }}
                </flux:button>
            </div>
        </flux:modal>
    </x-slot>
</x-action-section>
