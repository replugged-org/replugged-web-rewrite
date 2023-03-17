@extends('layouts.backoffice')

@push('css')
    <style>
        .title {
            margin-bottom: 16px;
        }

        .separator {
            border-bottom: 1px solid var(--background-tertiary);
        }

        .form-field {
            margin: 16px 0;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--background-tertiary);
            position: relative;
        }

        .form-label {
            display: block;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 0 0 8px;
            width: calc(100% - 64px);
        }

        .text-field {
            display: block;
            width: 100%;
            border: 1px solid var(--background-tertiary);
            background-color: var(--background-secondary);
            outline: none;
            font: inherit;
            color: inherit;
            padding: 4px 8px;
            border-radius: 4px;
            margin-top: 8px;
        }

        .form-note {
            font-size: .9rem;
            color: var(--text-dark);
            margin: 8px 0 0;
        }

        .tab-bar {
            display: flex;
            border-bottom: 3px solid var(--background-tertiary);
            margin-bottom: 16px;
            gap: 24px;
        }

        .tab {
            padding: 8px;
            cursor: pointer;
            position: relative;
        }

        .tab[aria-selected="true"] {
            padding-bottom: 11px;
            margin-bottom: -3px;
            border-bottom: 3px solid var(--blurple);
        }

        .tab+.tab::before {
            content: "";
            position: absolute;
            width: 2px;
            height: 60%;
            top: 20%;
            left: -12px;
            background-color: var(--background-secondary);
        }
    </style>
@endpush

@push('body-js')
    <script>
        // The custom tab router. Don't ask.
        let tabBar = document.querySelector(".tab-bar");
        let currentTab = tabBar.children[0];
        let currentTabContent = document.getElementById("manage");
        for (let tab of tabBar.children) {
            tab.addEventListener("click", function() {
                let tabId = tab.textContent.trim().toLowerCase().replace(" ", "-");
                let tabContent = document.getElementById(tabId);
                currentTabContent.style.display = "none";
                currentTab.removeAttribute("aria-selected");
                tabContent.style.display = "block";
                this.setAttribute("aria-selected", "true")
                currentTabContent = tabContent;
                currentTab = this;
            })
        }
    </script>
@endpush

@section('b-content')
    {{-- TODO: Set up a new route for this --}}
    <h3 class="title">Editing User - {{ $user->name }}#{{ $user->discriminator }}</h3>
    <form enctype="multipart/form-data" action="{{ RoutePro::BACKOFFICE_USERS_MANAGE($user->discord_id) }}" method="POST">
        @csrf
        <div class="tab-bar">
            <div class="tab" aria-selected="true">Manage</div>
            <div class="tab">Perks</div>
            <div class="tab">Guild badge</div>
        </div>

        <div id="manage" style="display: block;">
            # TODO: Switch components
        </div>
        <div id="perks" style="display: none;">
            <div class="form-field">
                <label for="badge_color" class="form-label">Badge color</label>
                <input id="badge_color" class="text-field" type="text" name="badge_color"
                    value="{{ $user->patreon_data->badge_color }}">
                <p class="form-note">hex code without the #. defaults to blurple.</p>
            </div>

            <div class="form-field">
                <label for="badge_url" class="form-label">Badge Icon</label>
                <input id="badge_url" class="text-field" type="text" name="badge_url"
                    value="{{ $user->patreon_data->badge }}">
                @isset($user->patreon_data->badge)
                    <img src="{{ $user->patreon_data->badge }}" />
                @endisset
            </div>

            <div class="form-field">
                <label for="badge_title" class="form-label">Badge Title</label>
                <input id="badge_title" class="text-field" type="text" name="badge_title"
                    value="{{ $user->patreon_data->badge_title }}">
            </div>
        </div>
        <div id="guild-badge" style="display: none;">
            <div class="form-field">
                <label for="guild_id" class="form-label">Guild ID</label>
                <input id="guild_id" class="text-field" type="text" name="guild_id"
                    value="{{ $user->patreon_data->guild_id }}">
            </div>

            <div class="form-field">
                <label for="guild_badge_url" class="form-label">Guild Badge</label>
                <input id="guild_badge_url" class="text-field" type="text" name="guild_badge_url"
                    value="{{ $user->patreon_data->guild_badge_url }}">
            </div>

            <div class="form-field">
                <label for="guild_tooltip" class="form-label">Guild Badge Tooltip</label>
                <input id="guild_tooltip" class="text-field" type="text" name="guild_tooltip"
                    value="{{ $user->patreon_data->guild_tooltip }}">
            </div>
        </div>
        <x-button type="submit">Save perks</x-button>
    </form>
@endsection
