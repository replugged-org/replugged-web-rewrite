<style>
    .linked-account-title {
        margin-bottom: 16px;
    }

    .linked-accounts {
        display: flex;
        flex-direction: column;
        margin-bottom: 40px;
        flex: 1 0;
    }

    .linked-accounts:first-child:last-child {
        grid-column: 1 / 3;
    }

    .linked-account {
        display: flex;
        margin-bottom: 16px;
        padding: 16px;
        gap: 24px;

        background-color: var(--background-secondary);
    }

    .linked-account-icon {
        width: 32px;
        height: 32px;
        margin-top: 4px;
        fill: currentColor;
        flex-shrink: 0;
    }

    .linked-account-info {
        flex: 3 0 auto;
    }

    .linked-account-header {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 8px;
        flex: 1;
    }

    .linked-account-actions {
        display: flex;
        gap: 16px;
    }

    .linked-account-action {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .linked-account-action svg {
        width: 16px;
        height: 16px;
    }

    .linked-account-explainer {
        font-size: 0.9em;
        opacity: 0.8;
    }

    .linked-account-error {
        display: flex;
        align-items: center;
        color: var(--red);
        margin-top: 8px;
        gap: 8px;
    }
</style>

@props(['platform', 'icon', 'explainer', 'account', 'refreshEndpoint'])

<div class="linked-account">
    <x-icon name="{{ $icon }}" class="linked-account-icon" />
    <div class="linked-account-info">
        <span>{{ $account->name ?? 'No account linked' }}</span>
        <div class="linked-account-actions">
            @if (!isset($account))
                <a href="{{ EndPro::LINK_ACCOUNT($platform) }}" class="linked-account-action">
                    <x-icon name="link" />
                    <span>Link accounts</span>
                </a>
            @endif
            @if (isset($account))
                <a href="{{ EndPro::UNLINK_ACCOUNT($platform) }}" class="linked-account-action">
                    <x-icon name="x-circle" />
                    <span>Unlink</span>
                </a>
            @endif
        </div>
    </div>
    <div class="linked-account-explainer">{{ $explainer }}</div>
</div>
