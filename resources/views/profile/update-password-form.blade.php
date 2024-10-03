<x-form-section submit="updatePassword">
    <x-slot name="title">
        {{ __('Update Password') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <flux:input label="{{ __('Current Password') }}" type="password" wire:model="state.current_password" autocomplete="current-password" viewable required/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input label="{{ __('New Password') }}" type="password" wire:model="state.password" autocomplete="new-password" viewable required/>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input label="{{ __('Confirm Password') }}" type="password" wire:model="state.password_confirmation" autocomplete="new-password" viewable required/>
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <flux:button variant="primary" type="submit">
            {{ __('Save') }}
        </flux:button>
    </x-slot>
</x-form-section>
