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

{{-- As much as I prefer not to do this, I don't see a clear way to *always*
pass a certain value to a *layout* from a Controller aside from passing the
value to every view, which in turn uses `@extends('...', ['key'=>$value])` to
send it up to the layout. I am afraid this is the closest I'll get. I don't mind
doing one extra query to get this working properly. --}}
@php
    use App\Models\User;
    $userCount = User::all()->count();
@endphp

@section('content')
    <div class="backoffice-container">
        <x-backoffice.sidebar :users="$userCount" />
        <div class="backoffice-content">
            <main>
                @yield('b-content')
            </main>
        </div>
    </div>
@endsection
