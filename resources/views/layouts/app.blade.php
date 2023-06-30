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
    @stack('head-js')

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Terrbly old TW version, also a temporary solution because I'm too lazy to write proper styles right now --}}
    @if(Request::is('store/*'))
        <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" />
    @endif
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

        <div x-data class="absolute bottom-0 right-0 p-4 max-w-sm overflow-x-hidden">
            <template
                x-for="(toast, index) in $store.toasts.list"
                :key="toast.id"
            >
                <div
                    x-show="toast.visible"
                    @click="$store.toasts.destroyToast(index)"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-y-2"
                    x-transition:enter-end="transform opacity-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform translate-x-full opacity-0"
                    class="bg-gray-900 bg-gradient-to-r text-white p-3 rounded mb-3 shadow-lg flex items-center"
                    :class="{
                        'from-blue-500 to-blue-600': toast.type === 'info',
                        'from-green-500 to-green-600': toast.type === 'success',
                        'from-yellow-400 to-yellow-500': toast.type === 'warning',
                        'from-red-500 to-pink-500': toast.type === 'error'
                    }"
                >
                    <div x-text="toast.message"></div>
                </div>
            </template>
        </div>

        <x-layout.footer></x-layout.footer>

    </div>
</body>
