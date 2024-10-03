<x-app-layout>
    <x-slot name="header">
        <flux:heading size="xl">
            {{ __('Create Team') }}
        </flux:heading>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('teams.create-team-form')
        </div>
    </div>
</x-app-layout>
