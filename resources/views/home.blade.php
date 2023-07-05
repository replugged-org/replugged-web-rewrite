@extends('layouts.app')

@push('css')
    <style>
        .home-container {
            margin: 0;
            padding: 0;
            max-width: none;
        }

        .wrapper {
            margin: 0 auto;
            max-width: 1300px;
            padding: 0 2em;
            width: 100%;
        }

        .heading {
            padding: 32px 0;
            text-align: center;
            background-color: var(--background-secondary);
            position: relative;
        }

        .title {
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .motto {
            margin: 0;
            font-size: 1.1rem;
            position: relative;
            margin-bottom: 24px;
            z-index: 2;
        }

        .buttons {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-buttons {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 32px;
        }

        .home-section {
            margin: 32px 0 64px;
        }

        .home-section-title {
            margin-bottom: 8px;
        }

        .home-section-description {
            margin: 0 0 24px;
        }

        .feature {
            margin-bottom: 32px;
        }

        .feature-icon {
            width: 56px;
            height: 56px;
            padding: 14px;
            background-color: var(--background-secondary);
            border-radius: 50%;
            margin-right: 16px;
        }

        .feature-title {
            margin: 8px 0 16px;
            font-weight: 600;
            font-size: 1.5rem;
        }

        .feature-description {
            margin: 0;
            padding: 0;
        }

        .feature-link {
            display: flex;
            align-items: center;
            margin-top: 16px;
        }

        .feature-link svg {
            height: 20px;
            width: 20px;
            margin-right: 4px;
        }

        .note {
            opacity: 0.6;
            font-size: 0.9rem;
            margin: 8px 0 0;
        }

        @media screen and (min-width: 860px) {
            .features {
                display: grid;
                gap: 40px 32px;
                grid-template-columns: 1fr 1fr;
            }

            .feature {
                margin-bottom: 0;
            }
        }

        @media screen and (min-width: 1240px) {
            .features {
                grid-template-columns: 1fr 1fr 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <main class="home-container">
        <div class="heading">
            <div class="wrapper">
                <h1 class="title">Powerful and simple Discord client mod</h1>
                <p class="motto">Enhance your Discord experience with new features and looks. Make your Discord truly yours.
                </p>
                <div class="header-buttons">
                    <x-button to="{{ RoutePro::DOWNLOAD() }}">
                        <x-icon name="zap" class="icon" />
                        <span>Download</span>
                    </x-button>
                    <x-button to="{{ RoutePro::DICKSWORD() }}" link>
                        <x-icon name="message-circle" class="icon" />
                        <span>Discord Server</span>
                    </x-button>
                </div>
            </div>
        </div>

        <div class="wrapper">
            <section class="home-section">
                <h2 class="home-section-title">Zero compromise experience</h2>
                <p class="home-section-description">
                    Replugged has everything you need to enhance your Discord client, without compromising on performance or
                    security.
                </p>

                <div class="features">
                    <x-home.feature icon="plugin" title="Plugins"
                        description="Adds new features to your Discord client, or enhance already existing once by extending them. You can even write your own plugins!" />
                    <x-home.feature icon="brush" title="Themes"
                        description="Give your Discord client a fresh new look, that matches your taste. You're no longer limited by what Discord gave you, only imagination!" />
                    <x-home.feature icon="pen-tool" title="Customizable"
                        description="Plugins and themes are fully customizable, through easy-to-use interfaces, allowing you to turn your Discord client into what you want, whatever that is. Unnecessary feature? Disable it. Don't like the color? Change it." />
                    <x-home.feature icon="feather" title="Lightweight"
                        description="Replugged is designed to consume as little resources as possible, and provides to plugin developers powerful tools to build efficient and robust plugins."
                        note="Note that Replugged still runs on top of the official client, and can't magically make it lighter. We just do our best to not consume even more resources." />
                    <x-home.feature icon="home" title="Feels like home"
                        description="We try to integrate as smoothly as possible within Discord's design language. Every modded element feels like it always has been there. You'll almost forget you're running a modded client!" />
                </div>
            </section>
            <hr />
            <section class="home-section">
                <h2 class="home-section-title">Powerful APIs for amazing plugins</h2>
                <p class="home-section-description">Replugged gives plugin and theme developers the tools they need to build
                    their next amazing plugin or theme.</p>

                <div class="features">
                    <x-home.feature icon="coffee" title="Standard Library"
                        description="Don't struggle with basic setup or boilerplate code. Replugged already provies everything you need to get started and do your patchwork."
                        linkto="{{ RoutePro::DOCS() }}" linklabel="Read the documentation" />
                </div>
            </section>
            <hr />
            <section class="home-section">
                <h2 class="home-section-title">Make your Discord spicier</h2>
                <p class="home-section-description">Stop limiting yourself to what Discord gives you. Get Replugged!</p>
                <div class="buttons">
                    <x-button to="{{ RoutePro::DOWNLOAD() }}">
                        <x-icon name="zap" class="icon" />
                        <span>Download</span>
                    </x-button>
                    <x-button to="{{ RoutePro::DICKSWORD() }}" link>
                        <x-icon name="message-circle" class="icon" />
                        <span>Discord Server</span>
                    </x-button>
                </div>
            </section>
        </div>
    </main>
@endsection
