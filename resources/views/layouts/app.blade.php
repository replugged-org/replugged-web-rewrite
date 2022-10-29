<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" @yield('htmlExt')>

<head>
    <title>
        @hasSection('title')
            @yield('title') • {{ Config::get('app.name') }}
        @else
            {{ Config::get('app.name') }}
        @endif
    </title>

    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="robots" content="noindex, nofollow, noarchive" />
    <meta name="referrer" content="never" />
    <meta name="referrer" content="no-referrer" />

    <link rel="icon" type="image/png" href="/build/images/replugged.png" />

    @yield('head')

    @stack('css')

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</html>

<body>
    <div id="app">

        <x-layout.header></x-layout.header>
        @if (Config::get('app.debug') == 1)
            <div class="debug-container">
                <code>@yield('debugcontent')</code>
            </div>
        @endif

        @yield('content')
        <x-layout.footer></x-layout.footer>

    </div>
</body>
