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

    'geter' => [

        'page' => [
            "guest" => 'Guest',
            "home" => 'Home',
            "user" => 'User',
            "item" => 'Item',
        ],

        'home' => [
            "all" => 'MyAll',
            "mine" => 'Mine',
            "timer" => 'MyTimer',
            "ask" => 'MyAskbar',
            "goods" => 'MyStore',
            "give" => 'MyGive',
            "working" => 'MyWorking',
            "finished" => 'MyFinished',
            "schedule" => 'MySchedule',
            "pm" => 'pmAll',
            "pmIn" => 'pmIn',
            "pmOut" => 'pmOut',
            "collect" => 'MyCollect',
            "favor" => 'MyFavor',
            "answer" => 'MyAnswer',
            "friend" => 'Friends',
            "friTimer" => 'FriTimer',
            "friAsk" => 'FriAskbar',
            "friGoods" => 'FriStore',
            "friGive" => 'FriGive',
        ],

        'guest' => [
            "all" => 'Guest',
            "timer" => 'GuestTimer',
            "ask" => 'GuestAskbar',
            "goods" => 'GuestStore',
            "give" => 'Give',
            "schedule" => 'GuestSchedule',
        ],

        'user' => [
            "all" => 'His',
            "timer" => 'HisTimer',
            "ask" => 'HisAskbar',
            "goods" => 'HisStore',
            "give" => 'HisGive',
        ],

        'schedule' => [
            "type" => [
                "year" => 'Year',
                "month" => 'Month',
                "week" => 'week',
                "day" => 'day',
            ],
        ],

    ],



];
