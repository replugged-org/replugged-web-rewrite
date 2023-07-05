<style>
    .icon {
        width: 18px;
        height: 18px;
    }
</style>

@props(['name', 'class'])

<div {{ $attributes }}>
    <?= Icons::get($name, $class ?? null) ?>
</div>

