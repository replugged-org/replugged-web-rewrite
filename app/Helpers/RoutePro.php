<?php

namespace App\Helpers;

use Exception;

/**
 * Utility class for fetching and dynamically generating route strings.
 *
 * @author lexisother
 */
class RoutePro
{
    /**
     * Automatically called by PHP once a non-existent static function is called.
     * The function allows for altering what occurs when this happens, instead
     * of PHP throwing an exception for you.
     *
     * @see https://www.php.net/manual/en/language.oop5.overloading.php#object.callstatic
     */
    public static function __callStatic($routeName, $parameters)
    {
        $Routes = [
            "HOME" => '/',
            "ME" => '/me',
            "EDIT_ME" => "/me/edit",
            "CONTRIBUTORS" => '/contributors',
            "STATS" => '/stats',
            "BRANDING" => '/branding',
            "INSTALL" => '/install',
            "FAQ" => '/faq',

            "STORE" => '/store',
            "STORE_PLUGINS" => '/store/plugins',
            "STORE_THEMES" => '/store/themes',
            "STORE_SUGGESTIONS" => 'https://github.com/replugged-org/suggestions/issues?q=is%3Aissue+is%3Aopen+label%3A%22up+for+grabs%22',
            "STORE_MANAGE" => '/store/manage',
            "STORE_FORMS" => '/store/forms',
            "STORE_PUBLISH" => '/store/forms/publish',
            "STORE_VERIFICATION" => '/store/forms/verification',
            "STORE_HOSTING" => '/store/forms/hosting',
            "STORE_COPYRIGHT" => '/store/copyright',

            "DOCS" => '/docs',
            "DOCS_ITEM" => function ($cat, $doc) {
                return "/docs/{$cat}/{$doc}";
            },
            "DOCS_GITHUB" => 'https://github.com/replugged-org/documentation',
            "GUIDELINES" => '/guidelines',
            "INSTALLATION" => '/installation',
            "PORKORD_LICENSE" => '/porkord-license',
            "TERMS" => '/legal/tos',
            "PRIVACY" => '/legal/privacy',

            // Backoffice links
            "BACKOFFICE" => '/backoffice',
            "BACKOFFICE_USERS" => '/backoffice/users',
            "BACKOFFICE_USERS_MANAGE" => function ($user) {
                return "/backoffice/users/{$user}";
            },
            "BACKOFFICE_BANS" => '/backoffice/bans',
            "BACKOFFICE_BANS_MANAGE" => function ($user) {
                return "/backoffice/bans/{$user}";
            },
            "BACKOFFICE_MONITORING" => '/backoffice/monitoring',
            "BACKOFFICE_STORE_ITEMS" => '/backoffice/store/items',
            "BACKOFFICE_STORE_TAGS" => '/backoffice/store/tags',
            "BACKOFFICE_STORE_FRONT" => '/backoffice/store/front',
            "BACKOFFICE_STORE_FORMS" => '/backoffice/store/forms',
            "BACKOFFICE_THREATS" => '/backoffice/threats',
            "BACKOFFICE_STORE_FORMS_FORM" => function ($id) {
                return "/backoffice/store/forms/{$id}";
            },
            "BACKOFFICE_STORE_REPORTS" => '/backoffice/store/reports',
            "BACKOFFICE_STORE_REPORTS_REPORT" => function ($id) {
                return "/backoffice/store/reports/{$id}";
            },
            "BACKOFFICE_EVENTS_SECRET" => '/backoffice/events/secret',
            "BACKOFFICE_BOT_TAGS" => '/backoffice/bot/tags',

            // External links
            "DICKSWORD" => 'https://discord.gg/HnYFUhv4x4',
            "GITHUB" => 'https://github.com/replugged-org/replugged',
            "TRANSLATIONS" => 'https://i18n.replugged.dev/projects/replugged/replugged',
            "PATREON" => 'https://google.com',
        ];

        $route = $Routes[$routeName] ?? null;

        if (!$route) throw new Exception("Route {$routeName} was not found.");

        if ($route instanceof \Closure) {
            return $route(...$parameters);
        } else {
            return $route;
        }
    }
}
