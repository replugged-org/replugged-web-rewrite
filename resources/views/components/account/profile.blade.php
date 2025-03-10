<style>
    .profile-container {
        width: 100%;
        border-radius: 8px;
        overflow: hidden;
        background-color: var(--background-secondary);
        margin-bottom: 16px;
        padding-bottom: 16px;
    }

    .banner {
        background-color: var(--blurple);
        width: 100%;
        height: 60px;
    }

    .profile-section {
        padding: 0 16px;
    }

    .decorations {
        display: flex;
        justify-content: space-between;
    }

    .profile-avatar {
        width: 96px !important;
        height: 96px !important;
        border: 6px solid var(--background-secondary);
        margin-top: -46px;
    }


    .props {
        font-size: 20px;
        font-weight: 600;
        padding: 8px 0 16px;
        border-bottom: 1px solid var(--background-primary);
        margin-bottom: 12px;
    }

    .profile-header {
        font-size: .85em;
        text-transform: uppercase;
        margin-bottom: 8px;
        font-weight: 600;
    }

    .roles {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }

    .role {
        display: flex;
        align-items: center;
        gap: 4px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 4px;
        background-color: var(--background-primary);
        padding: 4px 8px;
    }

    .role-round {
        border-radius: 50%;
        width: 12px;
        height: 12px;
    }

    .role-blurple {
        background-color: var(--blurple);
    }

    .role-pink {
        background-color: #f4abba;
    }
</style>

@props(['user'])

<div class="profile-container">
    <div class="banner"></div>
    <div class="profile-section">
        <div class="decorations">
            <x-images.avatar class="profile-avatar" />
            <x-account.badges :perks="$user->patreon_data" :flags="$user->flags" />
        </div>
        <div class="props">
            {{ $user->name }}
        </div>
    </div>
    <div class="profile-section">
        <h3 class="profile-header">Roles</h3>
        <div class="roles">
            <div class="role">
                <div class="role-round role-blurple"></div>
                <span>Replugged Supporter</span>
            </div>
            <div class="role">
                <div class="role-round role-pink"></div>
                <span>Tier {{ $user->patreon_data->pledge_tier }} Supporter</span>
            </div>
        </div>
    </div>
</div>
