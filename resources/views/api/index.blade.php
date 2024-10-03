<x-app-layout>
    <x-slot name="header">
        <flux:heading size="xl">
            {{ __('API Tokens') }}
        </flux:heading>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @livewire('api.api-token-manager')
        </div>
    </div>
</x-app-layout>
