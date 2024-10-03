<x-form-section submit="createTeam">
    <x-slot name="title">
        {{ __('Team Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new team to collaborate with others on projects.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <flux:heading>{{ __('Team Owner') }}</flux:heading>

            <div class="flex items-center mt-4">
                <img class="w-12 h-12 rounded-full object-cover" src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}">

                <div class="ms-4 leading-tight">
                    <flux:heading>{{ $this->user->name }}</flux:heading>
                    <flux:subheading>{{ $this->user->email }}</flux:subheading>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <flux:input label="{{ __('Team Name') }}" type="text" wire:model="state.name" autofocus />
        </div>
    </x-slot>

    <x-slot name="actions">
        <flux:button variant="primary" type="submit">{{ __('Create') }}</flux:button>
    </x-slot>
</x-form-section>
