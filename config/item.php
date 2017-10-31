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

    'itemBlade' => [
        'isShared_show' => [
            0 => '分享',
            21 => '分享',
            41 => '密友可见',
            61 => '粉丝可见',
            100 => '所有人可见',
        ],

        'sortName' => [
            0 => '',
            1 => '消息',
            19 => '私信',
            21 => '笔记',
            31 => '',
            41 => '轻博',
            44 => '提问',
            48 => '商品',
        ],

        'sortColor' => [
            0 => '',
            1 => '',
            19 => '',
            21 => '',
            31 => '',
            41 => '',
            44 => '',
            48 => '',
        ],

        'impotanceName' => [
            0 => '',
            1 => '一般',
            2 => '普通',
            3 => '重要',
            4 => '紧急',
            5 => '重要并紧急',
        ],

        'impotanceColor' => [
            0 => '_grey',
            1 => '',
            2 => '',
            3 => '',
            4 => '',
            5 => '',
        ],

        'scoreSort' => [
            1 => '1很差',
            2 => '2较差',
            3 => '3还行',
            4 => '4推荐',
            5 => '5力荐',
        ],

    ],

    'user_item_type' => [
        0 => 'favor',
        1 => 'score',
        2 => 'work',
        3 => 'agenda',
        4 => 'collect',
        5 => 'focus',
    ],

    'operate' => [
        'favor' => [
            'add' => 'favorIt',
            'cansel' => 'favorCansel',
        ],
        'collect' => [
            'add' => 'collectIt',
            'cansel' => 'collectCansel',
        ],
        'focus' => [
            'add' => 'focusIt',
            'cansel' => 'focusCansel',
        ],
        'work' => [
            'add' => 'workIt',
            'cansel' => 'workCansel',
        ],
        'agenda' => [
            'add' => 'agendaIt',
            'cansel' => 'agendaCansel',
        ],
    ],

];
