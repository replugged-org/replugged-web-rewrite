<style>
    .avatar {
        width: 56px;
        height: 56px;
        flex-shrink: 0;
        border-radius: 50%;
        user-select: none;
        -webkit-user-drag: none;
    }
</style>

@props(['user'])

@if ($user ?? false)
    {{-- Implement fetching of Discord avatar --}}
    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}'s avatar"
        {{ $attributes->merge(['class' => 'avatar']) }} />
@else
    {{-- Implement fetching of saved avatar from backend --}}
    <img src="https://placekitten.com/128/128" alt="{{ Auth::user()->name }}'s avatar"
        {{ $attributes->merge(['class' => 'avatar']) }} />
@endif
