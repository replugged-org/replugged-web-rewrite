<style>
    .backoffice-sidebar {
        width: 100%;
        height: 100%;
        position: fixed;
        display: flex;
        flex-direction: column;
        pointer-events: none;
        z-index: 1;
    }

    .backoffice-sidebar-inner {
        z-index: 2;
        height: 100%;
        position: relative;
        transform: translate(-100%);
        transition: transform .3s;
        background-color: var(--background-secondary);
        flex-direction: column;
        align-items: flex-end;
        overflow-y: scroll;
        padding: 24px 16px;
        display: flex;
        width: 256px;
        z-index: 1;
        top: 0;
    }

    .backoffice-sidebar-inner>* {
        width: 205px;
    }

    .backoffice-sidebar-inner h1 {
        font-size: 1.45rem;
        margin-bottom: 8px;
    }

    .backoffice-sidebar-inner h3 {
        font-size: .9rem;
        font-weight: 600;
        text-transform: uppercase;
        margin: 16px 0 12px;
        padding: 16px 0 0;
        border-top: 1px solid var(--background-tertiary);
    }

    .backoffice-sidebar-item {
        display: flex;
        align-items: center;
        color: var(--text-color);
        padding: 6px 12px;
        padding-left: 12px;
        margin-bottom: 4px;
        border-radius: 3px;
    }

    .backoffice-sidebar-item svg {
        width: 24px;
        height: 24px;
        margin-right: 12px;
    }

    .active {
        border-left: 4px var(--blurple) solid;
        background-color: var(--background-tertiary);
        padding-left: 8px;
    }

    @media screen and (min-width: 1010px) {
        .backoffice-sidebar {
            top: 0;
            position: sticky;
            pointer-events: all;
            width: 25%;
        }

        .backoffice-sidebar-inner {
            width: 100%;
            position: initial;
            transform: none;
        }
    }
</style>

{{-- :harold: --}}
@php
    function activeOrNot($name)
    {
        return strpos(Route::currentRouteName(), $name) == 0 ? 'active' : '';
    }
@endphp

@props(['users'])

<div class="backoffice-sidebar">
    <div class="backoffice-sidebar-inner">
        <h1>Administration</h1>
        <a class="backoffice-sidebar-item {{ activeOrNot('backoffice.users') }}"
            href="{{ RoutePro::BACKOFFICE_USERS() }}">
            <x-icon name="smile" />
            <span>Users ({{ $users }})</span>
        </a>
    </div>
</div>
