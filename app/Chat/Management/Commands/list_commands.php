<?php

    return [
        'email' => [
            'class' => 'SendToEmailMessages',
            'mandatory' => [],
            'related' => [
                '--bcc',
                '--cc',
            ]
        ],
        'join' => [
            'class' => 'SlackBotJoin',
            'mandatory' => [],
            'related' => [
                '--bcc',
                '--cc',
            ]
        ],
    ];
