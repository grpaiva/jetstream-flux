<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div x-data="{ recovery: false }">

            <flux:subheading x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </flux:subheading>

            <flux:subheading x-cloak x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </flux:subheading>

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div class="mt-4 space-y-6">
                    <div>
                        <div x-show="! recovery">
                            <flux:input type="text" name="code" label="{{ __('Code') }}" x-ref="code" autofocus autocomplete="one-time-code"/>
                        </div>

                        <div x-cloak x-show="recovery">
                            <flux:input type="text" name="recovery_code" label="{{ __('Recovery Code') }}" x-ref="recovery_code" autocomplete="one-time-code"/>
                        </div>
                    </div>

                    <div class="flex items-center justify-end">
                        <flux:link variant="subtle" href="#" class="text-sm" x-show="! recovery"
                                   x-show="! recovery"
                                   x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                            {{ __('Use a recovery code') }}
                        </flux:link>

                        <flux:link variant="subtle" href="#" class="text-sm hover:pointer" x-cloak x-show="recovery"
                                   x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                            {{ __('Use an authentication code') }}
                        </flux:link>

                        <flux:button variant="primary" type="submit" class="ms-4">
                            {{ __('Log in') }}
                        </flux:button>
                    </div>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
