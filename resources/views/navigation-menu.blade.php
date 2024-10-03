<div>
    <!-- Primary Navigation Menu -->
    <flux:header container class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700">

        <!-- Logo -->
        <flux:brand href="{{ route('dashboard') }}">
            <x-application-mark class="block w-auto"/>
        </flux:brand>

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item href="{{ route('dashboard') }}">{{ __('Dashboard') }}</flux:navbar.item>
        </flux:navbar>

        <flux:spacer />

        <!-- Teams Dropdown -->
        @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <flux:dropdown position="top" align="end" class="max-lg:hidden">
                <flux:navbar.item icon-trailing="chevron-up-down">{{ Auth::user()->currentTeam->name }}</flux:navbar.item>

                <flux:menu>
                    <flux:menu.group heading="{{ __('Manage Team') }}">
                        <flux:menu.item href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">{{ __('Team Settings') }}</flux:menu.item>

                        @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <flux:menu.item href="{{ route('teams.create') }}">{{ __('Create New Team') }}</flux:menu.item>
                        @endcan
                    </flux:menu.group>

                    @if (Auth::user()->allTeams()->count() > 1)

                        <flux:menu.group heading="{{ __('Switch Teams') }}">
                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                            @endforeach
                        </flux:menu.group>
                    @endif
                </flux:menu>
            </flux:dropdown>
        @endif

        <!-- Settings Dropdown -->
        <flux:dropdown position="top" align="end" class="max-lg:hidden">

            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <flux:profile avatar="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" icon-trailing="chevron-down" />

            @else
                <flux:navbar.item icon-trailing="chevron-down">{{ Auth::user()->name }}</flux:button>
            @endif

            <flux:menu>
                <flux:menu.group heading="{{ __('Manage Account') }}">
                    <flux:menu.item href="{{ route('profile.show') }}">{{ __('Profile') }}</flux:menu.item>

                    @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                        <flux:menu.item href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</flux:menu.item>
                    @endif

                </flux:menu.group>
                <flux:menu.group>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf

                        <flux:menu.item href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</flux:menu.item>
                    </form>
                </flux:menu.group>
            </flux:menu>

        </flux:dropdown>

        <flux:sidebar.toggle class="lg:hidden" icon="bars-3" inset="left" />

    </flux:header>

    <!-- Responsive Navigation Menu -->
    <flux:sidebar stashable sticky class="lg:hidden bg-zinc-50 dark:bg-zinc-900 border-r border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />
        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" href="{{ route('dashboard') }}">{{ __('Dashboard') }}</flux:navlist.item>

            <!-- Teams Navlist Group -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <flux:navlist.group expandable heading="{{ __('Teams') }}">
                    <flux:navlist.item href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">{{ __('Team Settings') }}</flux:navlist.item>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <flux:navlist.item href="{{ route('teams.create') }}">{{ __('Create New Team') }}</flux:navlist.item>
                    @endcan

                    @if (Auth::user()->allTeams()->count() > 1)
                        <flux:navlist.group heading="Switch Teams">
                            @foreach (Auth::user()->allTeams() as $team)
                                <x-switchable-team :team="$team" />
                            @endforeach
                        </flux:navlist.group>
                    @endif
                </flux:navlist.group>
            @endif

            <!-- Settings Navlist Group -->

            <flux:navlist.group expandable heading="Settings">
                <flux:navlist.item href="{{ route('profile.show') }}">{{ __('Profile') }}</flux:navlist.item>
                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <flux:navlist.item href="{{ route('api-tokens.index') }}">{{ __('API Tokens') }}</flux:navlist.item>
                @endif
            </flux:navlist.group>

            <!-- Authentication Navlist Group -->
            <flux:navlist.group>
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <flux:navlist.item href="{{ route('logout') }}" @click.prevent="$root.submit();">{{ __('Log Out') }}</flux:navlist.item>
                </form>
            </flux:navlist.group>
        </flux:navlist>
    </flux:sidebar>
</div>
