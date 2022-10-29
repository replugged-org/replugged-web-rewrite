<style>
    .icon {
        width: 18px;
        height: 18px;
    }
</style>

@props(['name'])

@php
    app('icons')->addCssClass('icon');
@endphp

<?= Icons::get($name) ?>
