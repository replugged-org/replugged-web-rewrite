@extends('layouts.app')

@push('css')
    <style>
        .title {
            margin-bottom: 16px;
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
    </style>
@endpush

@section('content')
    <main>
        <h2 class="title">Replugged Supporter Perks</h2>
        <form enctype="multipart/form-data" action="{{ RoutePro::EDIT_ME() }}" method="POST">
            @csrf
            <div class="form-field">
                <label for="badge_color" class="form-label">Badge Color</label>
                <input id="badge_color" class="text-field" type="text" name="badge_color"
                    value="{{ $user->patreon_data->badge_color }}">
                <p class="form-note">Color of your Replugged badges, in hex (without the #). Has no effect if you use a
                    custom icon and you don't have other badges. Leave blank for default blurple.</p>
            </div>

            <div class="form-field">
                <label for="badge_url" class="form-label">Badge Icon</label>
                <input id="badge_url" class="text-field" type="text" name="badge_url"
                    value="{{ $user->patreon_data->badge }}">
                <p class="form-note">Icon to set as your custom badge. URL must be from Discord (no external links). Leave
                    blank for the colored hibiscus.</p>
            </div>

            <div class="form-field">
                <label for="badge_title" class="form-label">Badge Title</label>
                <input id="badge_title" class="text-field" type="text" name="badge_title"
                    value="{{ $user->patreon_data->badge_title }}">
                <p class="form-note">Tooltip text showing when people hover your badge. Leave blank for default text.</p>
            </div>
            <x-button type="submit">Save perks</x-button>
        </form>
    </main>
@endsection
