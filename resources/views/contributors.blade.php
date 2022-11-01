@extends('layouts.app')

@push('css')
    <style>
        .contributors-section {
            margin: 40px 0 24px;
        }

        .contributors-section:first-child {
            margin-top: 0;
        }

        .contributors-wrapper {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
            grid-gap: 1rem;
        }
    </style>
@endpush

@section('title')
    Contributors
@endsection

@section('content')
    <main>
        <h2 class="contributors-section">Developers</h2>
        <div class="contributors-wrapper">
            @foreach ($contributors['developers'] as $user)
                <x-contributors.contributor :user="$user" />
            @endforeach
        </div>
        <h2 class="contributors-section">Replugged Staff &amp; Support</h2>
        <div class="contributors-wrapper">
            @foreach ($contributors['staff'] as $user)
                <x-contributors.contributor :user="$user" />
            @endforeach
        </div>
        <h2 class="contributors-section">Contributors</h2>
        <div class="contributors-wrapper">
            @foreach ($contributors['contributors'] as $user)
                <x-contributors.contributor :user="$user" />
            @endforeach
        </div>
    </main>
@endsection
