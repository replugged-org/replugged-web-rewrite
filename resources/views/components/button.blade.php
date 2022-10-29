<style>
    .green,
    .button-link.green {
        color: var(--green);
    }

    .red,
    .button-link.red {
        color: var(--red);
    }

    .buttons {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .button,
    .button-link,
    .button-border {
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: filter .2s, background .2s;
        gap: 8px;
    }

    .button,
    .button-border {
        height: 36px;
        min-width: 60px;
        padding: 2px 16px;
        border-radius: 3px;
        user-select: none;
    }

    .button {
        font-size: 0.9em;
        background-color: var(--blurple);
        font-weight: 600;
    }

    .button.green {
        color: #fff;
        background-color: var(--green);
    }

    .button.red {
        color: #fff;
        background-color: var(--red);
    }

    .button:hover {
        filter: brightness(.9);
        text-decoration: none;
    }

    .button:disabled {
        cursor: not-allowed;
        filter: brightness(.7);
    }

    .button-border {
        border: 1px solid var(--blurple);
        color: var(--blurple);
    }

    .button-border.green {
        border-color: var(--green);
    }

    .button-border.red {
        border-color: var(--red);
    }

    .button-border:hover {
        text-decoration: none;
        background-color: var(--blurple-t);
    }

    .button-border.green:hover {
        border-color: var(--green);
        background-color: var(--green-t);
    }

    .button-border.red:hover {
        border-color: var(--red);
        background-color: var(--red-t);
    }

    .button-link {
        color: var(--blurple);
    }

    .button-link:hover {
        text-decoration: underline;
    }

</style>

@props(['to', 'link', 'border', 'color'])

@php
    $mainClass = 'button';
    $mainClass = isset($border) ? 'button-border' : $mainClass;
    $mainClass = isset($link) ? 'button-link' : $mainClass;
    $classes = [$mainClass];
    $classes[] = $color ?? '';
    $classes = trim(implode(' ', $classes));
@endphp

<a href="{{ $to }}" {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
