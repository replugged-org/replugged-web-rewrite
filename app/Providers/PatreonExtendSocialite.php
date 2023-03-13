<?php

namespace App\Providers;

use SocialiteProviders\Manager\SocialiteWasCalled;

// TODO: Find better place for this damn thing
class PatreonExtendSocialite {
    public function handle(SocialiteWasCalled $socialiteWasCalled) {
        $socialiteWasCalled->extendSocialite('patreon', PatreonProvider::class);
    }
}
