@props(['id', 'label', 'required', 'note', 'error'])

<div class="field">
    <label class="label" for="{{ $id }}">
        {{ $label }}
        @if (isset($required) && $required)
            <span class="required">*</span>
        @endif
        {{ $slot }}
        @if (isset($note))
            <p class="note">{{ $note }}</p>
        @endif
        @if (isset($error))
            <p style="color: var(--red)">{{ $error }}</p>
        @endif
    </label>
</div>
