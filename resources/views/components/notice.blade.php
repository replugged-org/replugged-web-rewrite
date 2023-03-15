<style>
    .notice {
        display: flex;
        align-items: center;
        font-size: .9em;
        font-weight: 600;
        margin-bottom: 16px;
        border-radius: 4px;
        padding: 12px;
        gap: 16px;
    }

    .notice-blurple {
        background-color: var(--blurple-t);
        border: 1px solid var(--blurple);
    }

    .notice-orange {
        background-color: var(--orange-t);
        border: 1px solid var(--orange);
    }

    .notice-red {
        background-color: var(--red-t);
        border: 1px solid var(--red);
    }
</style>

@props(['color'])

<div class="notice notice-{{ $color }}" {{ $attributes }}>
    <span>
        {{ $slot }}
    </span>
</div>
