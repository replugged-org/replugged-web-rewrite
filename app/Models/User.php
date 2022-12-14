<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Developer status. Public
     */
    const FLAG_DEVELOPER = 1 << 0;
    /**
     * Admin status. Public
     */
    const FLAG_ADMIN = 1 << 1;
    /**
     * Staff status. Public
     */
    const FLAG_STAFF = 1 << 2;
    /**
     * Moderator status. Public
     */
    const FLAG_MODERATOR = 1 << 3;
    /**
     * Support status. Public
     */
    const FLAG_SUPPORT =  1 << 4;
    /**
     * Contributor status. Public
     */
    const FLAG_CONTRIBUTOR = 1 << 5;
    /**
     * Translator status. Public
     */
    const FLAG_TRANSLATOR = 1 << 6;
    /**
     * Bug hunter status. Public
     */
    const FLAG_BUG_HUNTER = 1 << 7;
    /**
     * Early user status. Public
     */
    const FLAG_EARLY_USER = 1 << 8;

    /**
     * User donated at least once. Public.
     */
    const FLAG_HAS_DONATED = 1 << 9;
    /**
     * User is currently a Powercord Cutie. Public.
     */
    const FLAG_IS_CUTIE = 1 << 10;
    /**
     * Status has been manually set by a staff. Private.
     */
    const FLAG_CUTIE_OVERRIDE = 1 << 11;

    /**
     * User currently has a published item in the store. Public.
     */
    const FLAG_STORE_PUBLISHER = 1 << 12;
    /**
     * User has at least one verified item in the store. Public.
     */
    const FLAG_VERIFIED_PUBLISHER = 1 << 13;

    /**
     * User is banned from logging in. Private.
     */
    const FLAG_BANNED = 1 << 14;
    /**
     * User is banned from publishing in the store. Private.
     */
    const FLAG_BANNED_PUBLISHER = 1 << 15;
    /**
     * User is banned from requesting verification. Private.
     */
    const FLAG_BANNED_VERIFICATION = 1 << 16;
    /**
     * User is banned from requesting hosting. Private.
     */
    const FLAG_BANNED_HOSTING = 1 << 17;
    /**
     * User is banned from submitting reports. Private.
     */
    const FLAG_BANNED_REPORTING = 1 << 18;
    /**
     * User is banned from using Sync. Private.
     */
    const FLAG_BANNED_SYNC = 1 << 19;
    /**
     * User is banned from participating in community events. Private.
     */
    const FLAG_BANNED_EVENTS = 1 << 20;

    /**
     * User appealed a support ban. Private.
     */
    const FLAG_APPEALED_SUPPORT = 1 << 21;
    /**
     * User appealed a server mute. Private.
     */
    const FLAG_APPEALED_MUTE = 1 << 22;
    /**
     * User appealed a server ban. Private.
     */
    const FLAG_APPEALED_BAN = 1 << 23;
    /**
     * User appealed a Sync ban. Private.
     */
    const FLAG_APPEALED_SYNC = 1 << 24;
    /**
     * User appealed a community events ban. Private.
     */
    const FLAG_APPEALED_EVENTS = 1 << 25;

    /**
     * User is a ghost entry (entry with no real user data, used for flag keeping purposes). Private.
     */
    const FLAG_GHOST = 1 << 26;

    /**
     * User has boosted the Discord server. Public.
     */
    const FLAG_SERVER_BOOSTER = 1 << 27;

    /**
     * Group of flags that are private.
     */
    const FLAG_GROUP_PRIVATE = 0 |
        self::FLAG_BANNED |
        self::FLAG_BANNED_PUBLISHER |
        self::FLAG_BANNED_VERIFICATION |
        self::FLAG_BANNED_HOSTING |
        self::FLAG_BANNED_REPORTING |
        self::FLAG_BANNED_SYNC |
        self::FLAG_BANNED_EVENTS |
        self::FLAG_APPEALED_SUPPORT |
        self::FLAG_APPEALED_MUTE |
        self::FLAG_APPEALED_BAN |
        self::FLAG_APPEALED_SYNC |
        self::FLAG_APPEALED_EVENTS |
        self::FLAG_GHOST;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'discord_id',
        'name',
        'email',
        'avatar',
        'discriminator',
        'discord_token',
        'discord_refresh_token',
        'flags',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
        'discord_token',
        'discord_refresh_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [];
}
