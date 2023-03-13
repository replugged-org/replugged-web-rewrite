<?php

namespace App\Providers;

use SocialiteProviders\Patreon\Provider;

/**
 * @author Ken Thompson
 */
class PatreonProvider extends Provider {
    protected $scopes = [
        'campaigns',
        'identity',
        'identity[email]',
        'identity.memberships',
        'campaigns.members',
        'campaigns.members[email]',
        'campaigns.members.address',
    ];
}

