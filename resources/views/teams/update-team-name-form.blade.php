<x-form-section submit="updateTeamName">
    <x-slot name="title">
        {{ __('Team Name') }}
    </x-slot>

    <x-slot name="description">
        {{ __('The team\'s name and owner information.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Team Owner Information -->
        <div class="col-span-6">
            <flux:heading>{{ __('Team Owner') }}</flux:heading>

            <div class="flex items-center mt-4">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $team->owner->profile_photo_url }}" alt="{{ $team->owner->name }}">

                <div class="ms-4 leading-tight">
                    <flux:heading>{{ $team->owner->name }}</flux:heading>
                    <flux:subheading>{{ $team->owner->email }}</flux:subheading>
                </div>
            </div>
        </div>

        <!-- Team Name -->
        <div class="col-span-6 sm:col-span-4">
            <flux:input
                label="{{ __('Team Name') }}"
                type="text"
                wire:model="state.name"
                autofocus
                :disabled="! Gate::check('update', $team)"
            />
        </div>
    </x-slot>

    @if (Gate::check('update', $team))
        <x-slot name="actions">
            <x-action-message class="me-3" on="saved">
                {{ __('Saved.') }}
            </x-action-message>

            <flux:button variant="primary" type="submit">{{ __('Save') }}</flux:button>

        </x-slot>
    @endif
</x-form-section>
