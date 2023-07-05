<style>
    .header-container {
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

    .header-link {
        font-size: .9rem;
    }

    .header-link+.header-link {
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

@php
    // TODO: See if there's a way that doesn't need attribute merging
    $headerClasses = $opened ?? false ? 'header-container opened' : 'header-container';

    // Test auth
    if (request('logged')) {
        $user = new \App\Models\User();
        Auth::login($user);
    }

    $isStaff = 0;
    if (Auth::check()) {
        $isStaff = Auth::user()->flags & \App\Models\User::FLAG_STAFF;
    }

    /** @see ../contributors/contributor.blade.php#L31-L38 */
    $user = Auth::user();
    if ($user) {
        $result = "<div class='username'>";
        if ($user->discriminator === "0") $result .= "@";
        $result .= $user->name;
        if ($user->discriminator !== "0") $result .= "<span class='discriminator'>#$user->discriminator</span>";
        $result .= "</div>";
    }
@endphp

<header {{ $attributes->merge(['class' => $headerClasses]) }}>
    <a class="logo" href="{{ route('home') }}">
        <x-images.replugged class='plug'/>
    </a>

    <nav class="nav">
        @if (Route::has('download'))
            <a class="nav-link" href="{{ route('download') }}">Download</a>
        @endif
        @if (Route::has('store'))
            <a class="nav-link" href="{{ RoutePro::STORE_PLUGINS() }}">Plugins</a>
            <a class="nav-link" href="{{ RoutePro::STORE_THEMES() }}">Themes</a>
        @endif
        @if (Route::has('contributors'))
            <a class="nav-link" href="{{ route('contributors') }}">Contributors</a>
        @endif
        <a class="nav-link" href="{{ RoutePro::DICKSWORD() }}">Discord Server</a>
    </nav>

    <div class="account">
        @guest
            <x-button to="/api/v1/login">Login with Discord</x-button>
        @else
            <div class="profile">
                <x-images.avatar/>
                <div class="details">
                    <div class="name">
                        {!! $result !!}
                        @if ($isStaff)
                            <x-icon name="badges.staff" class="badge"/>
                        @endif
                    </div>
                    <div>
                        <a class="header-link" href="{{ RoutePro::ME() }}">Account</a>
                        <a class="header-link" href="{{ EndPro::LOGOUT() }}">Logout</a>
                    </div>

                    @if ($isStaff)
                        <a class="header-link" href="{{ RoutePro::BACKOFFICE() }}">Administration</a>
                    @endif
                </div>
            </div>
        @endguest
</header>
