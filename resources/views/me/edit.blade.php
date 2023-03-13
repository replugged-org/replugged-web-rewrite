@extends('layouts.app')

@push('css')
@endpush

@section('content')
    <main>
        <form enctype="multipart/form-data" action="{{ RoutePro::EDIT_ME() }}" method="POST">
            @csrf
            <input type="text" name="badge_url">
            <input type="text" name="badge_color">
            <input type="text" name="badge_title">

            <x-button type="submit">Save perks</x-button>
        </form>
    </main>
@endsection
