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
        function validate(e) {
            if (isNaN(e)) return true;
            else return false;
        }
    </script>
@endpush

@section('b-content')
    <h1 class="title">Manage users</h1>
    {{-- TODO(lexisother): Any nicer way than using `$watch`? --}}
    <div x-data="{ value: '', err: false }" x-init="$watch('value', v => err = validate(v))">
        <x-notice x-show="err" id="error-notice" color="red">
            Invalid input!
        </x-notice>
        <div class="toolbar">
            <input x-model="value" type="text" placeholder="User ID" class="text-field" id="id-input" />
            <x-button id="submit-edit" to="{{ RoutePro::BACKOFFICE_USERS() }}">Edit User</x-button>
        </div>
    </div>
@endsection
