<?php

namespace App\Helpers;

class EndPro
{
    public static function __callStatic($endpointName, $parameters)
    {
        $Endpoints = [
            "LOGIN" => '/api/v1/login',
            "LOGOUT" => '/api/v1/logout',
            "USER_SELF" => '/api/v1/users/@me',
            "FETCH_USER" => function ($id) {
                return "/api/v1/users/{$id}";
            },
            "USER_REFRESH_PLEDGE" => '/api/v1/users/@me/refresh-pledge',
            "LINK_ACCOUNT" => function ($platform) {
                return "/api/v1/oauth/{$platform}";
            },
            "UNLINK_ACCOUNT" => function ($platform) {
                return "/api/v1/oauth/{$platform}/unlink";
            },
            "YEET_ACCOUNT" => '/api/v1/oauth/discord/unlink',
            "USER_AVATAR" => function ($id) {
                return "/api/v1/avatars/{$id}.png";
            },
            "USER_AVATAR_DISCORD" => function ($id, $avatar) {
                return "https://cdn.discordapp.com/avatars/{$id}/{$avatar}.png?size=128";
            },
            "DEFAULT_AVATAR_DISCORD" => function ($discrim) {
                $discrim = $discrim % 6;
                return "https://cdn.discordapp.com/embed/avatars/{$discrim}.png?size=128";
            },

            "STORE_FORM_ELIGIBILITY" => '/api/v1/store/forms/eligibility',
            "STORE_FORM" => function ($id) {
                return "/api/v1/store/forms/{$id}";
            },

            "DOCS_CATEGORIES" => '/api/v1/docs/categories',
            "DOCS_DOCUMENT" => function ($doc) {
                return "/api/v1/docs/{$doc}";
            },
            "DOCS_CATEGORIZED" => function ($cat, $doc) {
                return "/api/v1/docs/{$cat}/{$doc}";
            },

            "STORE_ITEMS" => function ($type) {
                return "/api/v1/store/items/{$type}";
            },
            "STORE_ITEM" => function ($type, $id) {
                return "/api/v1/store/items/{$type}/{$id}";
            },

            "CONTRIBUTORS" => '/api/v1/stats/contributors',
            "STATS" => '/api/v1/stats/numbers',

            "BACKOFFICE_USERS" => '/api/v1/backoffice/users',
            "BACKOFFICE_USER" => function ($id) {
                return "/api/v1/backoffice/users/{$id}";
            },
            "BACKOFFICE_BANS" => '/api/v1/backoffice/bans/',
            "BACKOFFICE_BAN" => function ($id) {
                return "/api/v1/backoffice/bans/{$id}";
            },
            "BACKOFFICE_FORMS" => '/api/v1/backoffice/forms?kind=hosting&kind=publish&kind=verification',
            "BACKOFFICE_FORMS_COUNT" => '/api/v1/backoffice/forms/count',
            "BACKOFFICE_FORM" => function ($id) {
                return "/api/v1/backoffice/forms/{$id}";
            },
            "BACKOFFICE_REPORTS" => '/api/v1/backoffice/forms?kind=reports',
            "BACKOFFICE_TAGS" => '/api/v1/backoffice/tags',
            "BACKOFFICE_TAG" => function ($id) {
                return "/api/v1/backoffice/tags/{$id}";
            },
            "BACKOFFICE_GET_USERS_GUILD_PERKS" => function ($user) {
                return "/api/v1/backoffice/users/perks/guild/{$user}";
            },
            "BACKOFFICE_USER_COUNT" => '/api/v1/backoffice/users/count',
        ];

        $route = $Endpoints[$endpointName];

        if (!$route) throw new Exception("Endpoint {$endpointName} was not found.");

        if ($route instanceof \Closure) {
            return $route(...$parameters);
        } else {
            return $route;
        }
    }
}
