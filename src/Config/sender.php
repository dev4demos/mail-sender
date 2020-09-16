<?php

return [
    'recipient' => [
        'address' => 'support@' . app('request')->getHost(), 'name' => null
    ],

    'message' => [
        'rules' => [
            'sender' => 'bail|nullable|email',
            'message_content' => 'bail|required'
        ]
    ]
];
