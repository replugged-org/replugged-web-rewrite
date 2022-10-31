@extends('layouts.app')

@push('css')
    <style>
        .404-container {
            height: calc(100% - 162px);
            padding-bottom: 0;
        }

        @media screen and (min-width: 890px) {
            .404-container {
                height: calc(100% - 143px);
            }
        }

        @media screen and (min-width: 1440px) {
            .404-container {
                height: calc(100% - 107px);
            }
        }
    </style>
@endpush

@section('title')
    404
@endsection

@section('content')
    <main class="404-container">
        <h1>Seems like you're lost...</h1>
        <p>
            <x-button to="{{ RoutePro::HOME() }}" link>Go back home</x-button>
        </p>
    </main>
@endsection
