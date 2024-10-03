<div class="min-h-screen flex flex-col sm:justify-center items-center space-y-6">
    <div>
        {{ $logo }}
    </div>

    <flux:card class="space-y-6 w-full sm:max-w-md mt-6 px-6 py-4">
        {{ $slot }}
    </flux:card>
</div>
