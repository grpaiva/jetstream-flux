<x-action-section xmlns:flush="http://www.w3.org/1999/html">
    <x-slot name="title">
        {{ __('Delete Team') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Permanently delete this team.') }}
    </x-slot>

    <x-slot name="content">
        <flux:subheading class="max-w-xl">
            {{ __('Once a team is deleted, all of its resources and data will be permanently deleted. Before deleting this team, please download any data or information regarding this team that you wish to retain.') }}
        </flux:subheading>

        <div class="mt-5">

            <flux:modal.trigger name="delete-team">
                <flux:button variant="danger">{{ __('Delete Team') }}</flux:button>
            </flux:modal.trigger>

        </div>

        <!-- Delete Team Confirmation Modal -->
        <flux:modal name="delete-team" class="min-w-[22rem] space-y-6">
            <div>
                <flux:heading size="lg">{{ __('Delete Team') }}?</flux:heading>

                <flux:subheading>
                    {{ __('Are you sure you want to delete this team? Once a team is deleted, all of its resources and data will be permanently deleted.') }}
                </flux:subheading>
            </div>

            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">{{ __('Cancel') }}</flux:button>
                </flux:modal.close>

                <flux:button wire:click="deleteTeam" variant="danger">{{ __('Delete Team') }}</flux:button>
            </div>
        </flux:modal>
    </x-slot>
</x-action-section>
