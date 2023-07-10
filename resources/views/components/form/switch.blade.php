@props(['name', 'label', 'value', 'required', 'note', 'error', 'disabled'])

<x-form.field :id="$name" :label="$label" :required="$required ?? false">
    <input
        type="checkbox"
        id="{{ $name }}"
        name="{{ $name }}"
        @if ($value) checked @endif
        @if (isset($required)) required @endif
        @if (isset($disabled)) disabled @endif
        class="checkbox-field"
    />
</x-form.field>
