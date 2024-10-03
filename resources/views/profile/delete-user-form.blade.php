<x-action-section>
    <x-slot name="title">
        {{ __('Delete Account') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete your account.') }}
    </x-slot>

    <x-slot name="content">
        <div class="max-w-xl">
            <flux:subheading>
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </flux:subheading>

        </div>

        <div class="mt-5">
            <flux:button variant="danger" wire:click="confirmUserDeletion">
                {{ __('Delete Account') }}
            </flux:button>
        </div>

        <!-- Delete User Confirmation Modal -->
        <flux:modal wire:model.live="confirmingUserDeletion" class="space-y-6">
            <div>
                <flux:heading>{{ __('Delete Account') }}</flux:heading>
                <flux:subheading>{{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</flux:subheading>
            </div>

            <div class="mt-4" x-data="{}" x-on:confirming-delete-user.window="setTimeout(() => $refs.password.focus(), 250)">
                <flux:input type="password" class="mt-1 block w-3/4"
                            autocomplete="current-password"
                            placeholder="{{ __('Password') }}"
                            x-ref="password"
                            wire:model="password"
                            wire:keydown.enter="deleteUser" />

                <flux:error name="password" class="mt-2" />
            </div>

            <flux:button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </flux:button>

            <flux:button variant="danger" class="ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </flux:button>
        </flux:modal>
    </x-slot>
</x-action-section>
