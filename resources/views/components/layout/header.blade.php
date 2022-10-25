<style>
    .container {
        height: 72px;
        padding: 8px 32px;
        display: flex;
        align-items: center;
        flex-shrink: 0;
        z-index: 10;
        position: relative;
    }

    .logo {
        display: flex;
        align-items: center;
        color: inherit;
        height: 100%;
    }

    .logo:hover {
        text-decoration: none;
    }

    .plug {
        height: 100%;
        margin-right: 8px;
        flex-shrink: 0;
    }

    .wordmark {
        display: none;
    }

    .nav {
        flex-direction: column;
        background-color: var(--background-secondary);
        position: absolute;
        right: 32px;
        top: 72px;
        display: none;
    }

    .nav-link {
        color: inherit;
        padding: 8px 16px;
    }

    .nav-link:not(:first-child) {
        border-top: 1px var(--background-tertiary) solid;
    }

    .opened .nav {
        display: flex;
    }

    .account {
        margin-left: auto;
    }

    .profile {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .link {
        font-size: .9rem;
    }

    .link+.link {
        margin-left: 8px;
    }

    .details {
        display: flex;
        flex-direction: column;
        line-height: 18px;
        max-width: 160px;
    }

    .name {
        display: flex;
        align-items: center;
    }

    .username {
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .discriminator {
        font-size: .8rem;
        color: var(--text-dark);
    }

    .badge {
        margin-left: 4px;
        flex-shrink: 0;
        width: 16px;
        height: 16px;
    }

    .b {
        margin-left: 16px;
    }

    @media screen and (min-width: 560px) {
        .wordmark {
            display: block;
            height: 20px;
            margin-right: 8px;
        }
    }

    @media screen and (min-width: 1010px) {
        .nav {
            background-color: transparent;
            position: initial;
            flex-direction: row;
            display: block;
        }

        .nav-link {
            margin-left: 24px;
            padding: 0;
        }

        .nav-link:not(:first-child) {
            border: none;
        }

        .b {
            display: none;
        }
    }
</style>

@props(['opened'])

{{-- TODO: See if there's a way that doesn't need attribute merging --}}
@php
    $headerClasses = $opened ?? false ? 'container opened' : 'container';
@endphp

<header {{ $attributes->merge(['class' => $headerClasses]) }}>
    <a class="logo">
        <x-icons.replugged class='plug' />
    </a>

    <nav class="nav">
        <a class="nav-link">Installation</a>
        <a class="nav-link">Store</a>
        <a class="nav-link">Contributors</a>
        <a class="nav-link">Discord Server</a>
    </nav>
</header>
