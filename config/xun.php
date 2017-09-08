<?php

    return [
        /*头像默认地址*/
        'avatar' => env('AVATAR','/images/avatars/default.jpg'),
        /*邮箱模板*/
        'email_sendcloud_template' => env('SEND_CLOUD_TEMPLATE','xun1009_register'),
        /*github配置*/
        'github' => [
            'client_id'     => '5417c5f6c5913adc71cf',
            'client_secret' => 'b77b8b1a9b4db343ca065e0ce7b1e718a1aa1060',
            'redirect'      => 'http://xun1009.dev/github/callback',
        ],
        'record_number' => env('RECORD_NUMBER',''),
    ];