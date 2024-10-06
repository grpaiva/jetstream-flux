<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="space-y-6">
                <flux:input name="name" label="{{ __('Name') }}" type="text" :value="old('name')" required autofocus autocomplete="name"/>

                <flux:input name="email" label="{{ __('Email') }}" type="email" :value="old('email')" required autofocus autocomplete="username"/>

                <flux:input name="password" type="password" label="{{ __('Password') }}" required autocomplete="new-password" viewable/>

                <flux:input name="password_confirmation" type="password" label="{{ __('Confirm Password') }}" required autocomplete="new-password" viewable/>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <flux:field variant="inline" x-data="{ terms: false }">
                        <input type="checkbox" name="terms" id="terms" x-model="terms" class="hidden"/>
                        <flux:checkbox x-model="terms"/>
                        <flux:label>
                            {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                    'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Terms of Service').'</a>',
                                    'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">'.__('Privacy Policy').'</a>',
                            ]) !!}
                        </flux:label>
                    </flux:field>
                @endif

                <div class="flex items-center justify-end">
                    <flux:link class="text-sm mr-2" href="{{ route('login') }}" variant="subtle">{{ __('Already registered?') }}</flux:link>

                    <flux:button variant="primary" type="submit">
                        {{ __('Register') }}
                    </flux:button>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
