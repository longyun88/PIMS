<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'get' => [
        'sort' => [
            'friend' => 'Friend',
            'follow' => 'Follow',
            'fans' => 'Fans',
        ],
    ],

    'operate' => [
        'follow' => [
            'add' => 'add_follow',
            'cansel' => 'cansel_follow',
        ],
    ],



];
