<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <flux:label>{{ __('Photo') }}</flux:label>

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <flux:button variant="outline" type="button" class="mt-2 me-2" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </flux:button>

                @if ($this->user->profile_photo_path)
                    <flux:button variant="outline" type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </flux:button>
                @endif

                <flux:error name="photo" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <flux:input label="{{ __('Name') }}" type="text" wire:model="state.name" required autocomplete="name" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <flux:input label="{{ __('Email') }}" type="email" wire:model="state.email" required autocomplete="username" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <div class="flex flex-col text-sm space-y-2 mt-3">
                    <flux:label>
                        {{ __('Your email address is unverified.') }}
                    </flux:label>
                    <flux:link href="#" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </flux:link>
                    @if ($this->verificationLinkSent)
                        <flux:label class="font-semibold !text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </flux:label>
                    @endif
                </div>
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <flux:button variant="primary" type="submit" wire:target="photo">
            {{ __('Save') }}
        </flux:button>
    </x-slot>
</x-form-section>
