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
                <div class="buttons">
                    <x-button to="{{ RoutePro::INSTALLATION() }}">
                        <x-icon name="zap" class="icon" />
                        <span>Installation</span>
                    </x-button>
                    <x-button to="{{ RoutePro::DICKSWORD() }}" link>
                        <x-icon name="message-circle" class="icon" />
                        <span>Discord Server</span>
                    </x-button>
                </div>
            </div>
        </div>
    </main>
@endsection
