<style>
    .icon {
        width: 18px;
        height: 18px;
    }
</style>

@props(['name', 'class'])

<?= Icons::get($name, $class ?? null) ?>
