<div>
    <!-- Generate API Token -->
    <x-form-section submit="createApiToken">
        <x-slot name="title">
            {{ __('Create API Token') }}
        </x-slot>

        <x-slot name="description">
            {{ __('API tokens allow third-party services to authenticate with our application on your behalf.') }}
        </x-slot>

        <x-slot name="form">
            <!-- Token Name -->
            <div class="col-span-6 sm:col-span-4">
                <flux:input
                    label="{{ __('Token Name') }}"
                    wire:model="createApiTokenForm.name"
                    autofocus
                    required
                />
            </div>

            <!-- Token Permissions -->
            @if (Laravel\Jetstream\Jetstream::hasPermissions())
                <div class="col-span-6">
                    <flux:checkbox.group wire:model="createApiTokenForm.permissions" label="{{ __('Permissions') }}">
                        @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                            <flux:checkbox label="{{ $permission }}" value="{{ $permission }}" />
                        @endforeach
                    </flux:checkbox.group>
                </div>
            @endif
        </x-slot>

        <x-slot name="actions">
            <x-action-message class="me-3" on="created">
                {{ __('Created.') }}
            </x-action-message>

            <flux:button variant="primary" type="submit">
                {{ __('Create') }}
            </flux:button>
        </x-slot>
    </x-form-section>

    @if ($this->user->tokens->isNotEmpty())
        <x-section-border />

        <!-- Manage API Tokens -->
        <div class="mt-10 sm:mt-0">
            <x-action-section>
                <x-slot name="title">
                    {{ __('Manage API Tokens') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('You may delete any of your existing tokens if they are no longer needed.') }}
                </x-slot>

                <!-- API Token List -->
                <x-slot name="content">
                    <div class="space-y-6">
                        @foreach ($this->user->tokens->sortBy('name') as $token)
                            <div class="flex items-center justify-between">
                                <div class="break-all dark:text-white">
                                    {{ $token->name }}
                                </div>

                                <div class="flex items-center ms-2">
                                    @if ($token->last_used_at)
                                        <div class="text-sm text-gray-400">
                                            {{ __('Last used') }} {{ $token->last_used_at->diffForHumans() }}
                                        </div>
                                    @endif

                                    @if (Laravel\Jetstream\Jetstream::hasPermissions())
                                        <button class="cursor-pointer ms-6 text-sm text-gray-400 underline" wire:click="manageApiTokenPermissions({{ $token->id }})">
                                            {{ __('Permissions') }}
                                        </button>
                                    @endif

                                    <button class="cursor-pointer ms-6 text-sm text-red-500" wire:click="confirmApiTokenDeletion({{ $token->id }})">
                                        {{ __('Delete') }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-slot>
            </x-action-section>
        </div>
    @endif

    <!-- Token Value Modal -->
    <flux:modal wire:model="displayingToken">
        <div class="space-y-6">
            <div>
                <flux:heading>{{ __('API Token') }}</flux:heading>
                <flux:subheading>
                    {{ __('Please copy your new API token. For your security, it won\'t be shown again.') }}
                </flux:subheading>
            </div>

            <flux:input icon="key" value="{{ $plainTextToken }}" readonly copyable />
        </div>

        <div class="flex mt-4">
            <flux:spacer />
            <flux:button wire:click="$toggle('displayingToken')" variant="outline">{{ __('Close') }}</flux:button>
        </div>
    </flux:modal>

    <!-- API Token Permissions Modal -->
    <flux:modal wire:model="managingApiTokenPermissions">
        <div class="space-y-6">
            <div>
                <flux:heading>{{ __('API Token Permissions') }}</flux:heading>
                <flux:subheading>
                    {{ __('Please assign the permissions for this API token.') }}
                </flux:subheading>
            </div>

            <flux:checkbox.group wire:model="updateApiTokenForm.permissions" label="{{ __('Permissions') }}">
                @foreach (Laravel\Jetstream\Jetstream::$permissions as $permission)
                    <flux:checkbox label="{{ $permission }}" value="{{ $permission }}" />
                @endforeach
            </flux:checkbox.group>

        </div>

        <div class="flex mt-4 space-x-2">
            <flux:spacer />
            <flux:button wire:click="$toggle('managingApiTokenPermissions')" variant="outline">{{ __('Close') }}</flux:button>
            <flux:button wire:click="updateApiToken" variant="primary">{{ __('Save') }}</flux:button>
        </div>
    </flux:modal>

    <!-- Delete Token Confirmation Modal -->
    <flux:modal wire:model="confirmingApiTokenDeletion">
        <div class="space-y-6">
            <div>
                <flux:heading>{{ __('Delete API Token') }}</flux:heading>
                <flux:subheading>
                    {{ __('Are you sure you would like to delete this API token?') }}
                </flux:subheading>
            </div>

            <div class="flex mt-4 space-x-2">
                <flux:spacer />
                <flux:button wire:click="$toggle('confirmingApiTokenDeletion')" variant="outline">{{ __('Cancel') }}</flux:button>
                <flux:button wire:click="deleteApiToken" variant="danger">{{ __('Delete') }}</flux:button>
            </div>
        </div>

    </flux:modal>
</div>
