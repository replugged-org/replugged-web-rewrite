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
</style>

@props(['user'])

<div class="contributor-container">
    <x-images.avatar :user="$user" />
    <div class="contributor-name">
        {{ $user->name }}
    </div>
</div>
