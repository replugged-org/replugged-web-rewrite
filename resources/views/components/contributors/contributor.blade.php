<style>
    .contributor-container {
        background-color: var(--background-secondary);
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .contributor-name {
        max-width: calc(100% - 88px);
    }

    .contributor-username {
        margin: 0;
        font-size: 24px;
        text-overflow: ellipsis;
        overflow: hidden;
        font-weight: 600;
    }

    .contributor-discriminator {
        font-size: .6em;
        opacity: 0.6;
    }
</style>

@props(['user'])

@php
// I'm not very proud of this. I've added this below block to avoid having to write some really ugly Blade:
// @if($user->discriminator == "0")<?= "@" {question mark here}>@endif{{ $user->name }}@if($user->discriminator !== "0")<span class="contributor-discriminator">#{{ $user->discriminator }}</span>@endif
// Submit a PR if you can do this in Blade without making it look ugly!
$result = "<div class='contributor-username'>";
if ($user->discriminator === "0") $result .= "@";
$result .= $user->name;
if ($user->discriminator !== "0") $result .= "<span class='contributor-discriminator'>#$user->discriminator</span>";
$result .= "</div>";
@endphp

<div class="contributor-container">
    <x-images.avatar :user="$user" />
    <div class="contributor-name">
        {!! $result !!}
    </div>
</div>
