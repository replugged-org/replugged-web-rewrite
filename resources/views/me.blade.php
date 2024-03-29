@extends('layouts.app')

@push('css')
    <style>
        .title {
            margin-bottom: 16px;
        }

        .columns {
            gap: 16px;
        }

        .linked-accounts {
            display: flex;
            flex-direction: column;
            margin-bottom: 40px;
            flex: 1 0;
        }

        .linked-accounts:first-child:last-child {
            grid-column: 1 / 3;
        }

        .perks-management {
            width: 100%;
        }

        .linked-account-error,
        .perks-management-error {
            display: flex;
            align-items: center;
            color: var(--red);
            margin-top: 8px;
            gap: 8px;
        }

        .perks-management-info,
        .perks-management-notice {
            display: flex;
            align-items: center;
            font-size: 0.9em;
            font-weight: 600;
            margin-bottom: 16px;
            border-radius: 4px;
            padding: 12px;
            gap: 16px;
        }

        .perks-management-info {
            background-color: var(--blurple-t);
            border: 1px solid var(--blurple);
        }

        .perks-management-notice {
            background-color: var(--orange-t);
            border: 1px solid var(--orange);
        }

        .perks-management-info svg {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }

        .linked-account-error {
            font-size: 0.9em;
        }

        .linked-account-error svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .perks-management-error svg {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
        }

        .separator {
            margin: 0 0 16px;
        }

        .paragraph {
            margin: 0;
            margin-bottom: 16px;
        }

        @media screen and (min-width: 1090px) {
            .linked-accounts {
                margin-bottom: 0;
            }

            .columns {
                display: flex;
            }

            .perks-management {
                width: 420px;
                margin-left: 48px;
            }
        }
    </style>
@endpush

@section('content')
    <main>
        <h1 class="title">Welcome back, {{ $user->name }}</h1>
        <div class="columns">
            <div class="linked-accounts">
                <h2 class="title">Linked Accounts</h2>
                <x-account.linked-account platform="patreon" :account="$patreon" icon="patreon"
                    explainer="Link your Patreon account to benefit from the Replugged Supporter perks, and manage them from here. If you pledged but don't see your perks, use the refresh button." />
            </div>
            @if (isset($user->patreon_data->pledge_tier) && $user->patreon_data->pledge_tier > 0)
                <div class="perks-management">
                    <h2 class="title">Replugged Supporter Perks</h2>
                    <x-account.profile :user="$user" />
                    <x-button to="{{ RoutePro::EDIT_ME() }}">Edit perks</x-button>
                </div>
            @endif
        </div>
    </main>
@endsection
