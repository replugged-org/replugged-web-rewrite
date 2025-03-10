@extends('layouts.app')

@push('css')
    <style>
        .backoffice-container {
            display: flex;
            overflow: hidden;
            border: 0 var(--background-tertiary) solid;
            border-top-width: 2px;
            border-bottom-width: 2px;
            position: relative;
            flex: 1;
        }

        .backoffice-contents {
            flex: 1;
            position: relative;
            padding: 24px;
            width: 100%;
            max-width: 1024px;
            overflow-y: auto;
            margin-top: 36px;
        }

        .backoffice-contents main {
            margin-top: -24px;
        }

        @media screen and (min-width: 1010px) {
            .backoffice-container {
                overflow-y: scroll;
                margin-top: 0;
            }

            .backoffice-contents {
                margin-top: 0;
                overflow-y: initial;
            }

            .backoffice-contents main {
                margin-top: 0;
            }
        }
    </style>
@endpush

@section('content')
    <div class="backoffice-container">
        <x-backoffice.sidebar :users="$userCount" />
        <div class="backoffice-contents">
            @yield('b-content')
        </div>
    </div>
@endsection
