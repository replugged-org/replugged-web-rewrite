@extends('layouts.app')

@push('css')
    <style scoped>
        .title {
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }
    </style>
@endpush

@section('content')
    <main>
        <h1 class="title">Welcome back, {{ $user->name }}</h1>

        <x-account.linked-account platform="patreon" icon="patreon" />
    </main>
@endsection
