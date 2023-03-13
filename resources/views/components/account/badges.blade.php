<style>
    .badges {
        display: flex;
        justify-content: flex-end;
        margin-top: 16px;
        flex-wrap: wrap;
        gap: 6px;
    }

    .badge {
        width: 18px;
        height: 18px;
    }
</style>

@php
    use App\Models\User;
@endphp

@props(['flags', 'perks'])

<div class="badges" style="color: #{{ $perks->badge_color ?? '7289da' }}">
    @if (isset($perks->badge) && $perks->badge != 'default')
        <img src="{{ $perks->badge }}" class="badge" />
    @else
        <x-icon name="badges.hibiscus-mono" class="badge" />
    @endif

    @if ($flags & User::FLAG_DEVELOPER)
        <x-icon name="badges.developer" class="badge" />
    @endif

    @if ($flags & User::FLAG_STAFF)
        <x-icon name="badges.staff" class="badge" />
    @endif

    @if ($flags & User::FLAG_SUPPORT)
        <x-icon name="badges.support" class="badge" />
    @endif

    @if ($flags & User::FLAG_CONTRIBUTOR)
        <x-icon name="badges.contributor" class="badge" />
    @endif

    @if ($flags & User::FLAG_TRANSLATOR)
        <x-icon name="badges.translator" class="badge" />
    @endif

    @if ($flags & User::FLAG_BUG_HUNTER)
        <x-icon name="badges.hunter" class="badge" />
    @endif

    @if ($flags & User::FLAG_EARLY_USER)
        <x-icon name="badges.early" class="badge" />
    @endif
</div>
