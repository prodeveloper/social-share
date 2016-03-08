<?php

return [
    'separator' => '&',
    'services' => [
        'delicious' => [ 'uri' => 'https://delicious.com/post' ],
        'digg' => [ 'uri' => 'http://www.digg.com/submit' ],
        'email' => [ 'view' => 'social-share::email' ],
        'evernote' => [ 'uri' => 'http://www.evernote.com/clip.action' ],
        'facebook' => [ 'uri' => 'https://www.facebook.com/sharer/sharer.php', 'urlName' => 'u',  ],
        'gmail' => [ 'uri' => 'https://mail.google.com/mail/', 'urlName' => 'su', 'titleName' => 'body', 'extra' => [
            'view' => 'cm',
            'fs' => 1,
            'to' => '',
            'ui' => 2,
            'tf' => 1,
        ]],
        'gplus' => [ 'uri' => 'https://plus.google.com/share', 'only' => [ 'url' ] ],
        'linkedin' => [ 'uri' => 'http://www.linkedin.com/shareArticle', 'extra' => [ 'mini' => 'true' ] ],
        'pinterest' => [ 'uri' => 'http://pinterest.com/pin/create/button/', 'titleName' => 'description', 'mediaName' => 'media' ],
        'reddit' => [ 'uri' => 'http://www.reddit.com/submit' ],
        'scoopit' => [ 'uri' => 'http://www.scoop.it/oexchange/share' ],
        'tumblr' => [ 'uri' => 'http://www.tumblr.com/share', 'urlName' => 'u', 'titleName' => 't', 'extra' => [
            'v' => 3,
        ]],
        'twitter' => [ 'uri' => 'https://twitter.com/intent/tweet', 'titleName' => 'text' ],
        'viadeo' => [ 'uri' => 'http://www.viadeo.com/' ],
        'vk' => [ 'uri' => 'http://vk.com/share.php', 'mediaName' => 'image', 'extra' => [
            'noparse' => 'false',
        ]],
        'whatsapp' => [ 'view' => 'social-share::whatsapp' ],
    ],
];
