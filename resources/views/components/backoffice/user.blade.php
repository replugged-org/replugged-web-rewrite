@pushonce('css')
    <style>
        /** ROW */
        .row {
            display: flex;
            padding: 16px;
            gap: 16px;
            border-bottom: 1px solid var(--background-tertiary);
            align-items: center;
        }

        .row-info {
            display: flex;
            flex-direction: column;
        }

        .row-actions {
            display: flex;
            margin-left: auto;
            gap: 16px;
        }

        .action {
            width: 24px;
            height: 24px;
        }
    </style>
@endpushonce

@props(['user'])

@php
    $result = "";
    if ($user->discriminator === "0") $result .= "@";
    $result .= "$user->name";
    if ($user->discriminator !== "0") $result .= "#$user->discriminator";
@endphp

<div class="row">
    <x-images.avatar :user="$user" />
    <div class="row-info">
        <span>
            {{ $result }}
        </span>
    </div>
    <div class="row-actions">
        <button class="action">
            <a href="{{ RoutePro::BACKOFFICE_USERS_MANAGE($user->discord_id) }}">
                <x-icon name="edit" />
            </a>
        </button>
        <button class="action">
            {{-- TODO: Confirmation modal using Alpine maybe? --}}
            <x-icon name="trash" style="color: var(--red)" />
        </button>
    </div>
</div>
