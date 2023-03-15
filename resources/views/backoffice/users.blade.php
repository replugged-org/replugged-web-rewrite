@extends('layouts.backoffice')

@push('css')
    <style>
        .title {
            margin-bottom: 24px;
        }

        .toolbar {
            display: flex;
            margin-bottom: 16px;
            gap: 16px;
        }

        .button {
            flex: 1 0 auto;
        }

        .text-field {
            display: block;
            width: 100%;
            border: 1px solid var(--background-tertiary);
            background-color: var(--background-secondary);
            outline: none;
            font: inherit;
            color: inherit;
            padding: 4px 8px;
            border-radius: 4px;
        }
    </style>
@endpush

{{-- No modals? :trollformation: --}}
@push('body-js')
    <script>
        let input = document.getElementById("id-input");
        let submit = document.getElementById("submit-edit");

        input.addEventListener("input", () => {
            submit.href = `/backoffice/users/${input.value}`;
        })
    </script>
@endpush

@section('b-content')
    <h1 class="title">Manage users</h1>
    <div class="toolbar">
        <input type="text" placeholder="User ID" class="text-field" id="id-input" />
        <x-button id="submit-edit" to="{{ RoutePro::BACKOFFICE_USERS() }}">Edit User</x-button>
    </div>
@endsection
