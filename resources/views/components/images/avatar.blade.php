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
    <img src="{{ $user->avatar }}" alt="{{ $user->name }}'s avatar" {{ $attributes->merge(['class' => 'avatar']) }} />
@else
    <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}'s avatar"
        {{ $attributes->merge(['class' => 'avatar']) }} />
@endif
