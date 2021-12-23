<?php

return [
    'separator' => '&',
    'services' => [
        'blogger' => [ 'uri' => 'https://www.blogger.com/blog-this.g', 'urlName' => 'u', 'titleName' => 'n' ],
        'digg' => [ 'uri' => 'https://digg.com/news/submit-link', 'only' => [ 'url' ] ],
        'email' => [ 'view' => 'social-share::email' ],
        'evernote' => [ 'uri' => 'http://www.evernote.com/clip.action' ],
        'facebook' => [ 'uri' => 'https://www.facebook.com/sharer/sharer.php', 'urlName' => 'u', 'titleName' => 'quote'],
        'gmail' => [ 'uri' => 'https://mail.google.com/mail/', 'urlName' => 'su', 'titleName' => 'body', 'extra' => [
            'view' => 'cm',
            'fs' => 1,
            'to' => '',
            'ui' => 2,
            'tf' => 1,
        ]],
        'linkedin' => [ 'uri' => 'https://www.linkedin.com/sharing/share-offsite/', 'only' => [ 'url' ] ],
        'pinterest' => [ 'uri' => 'https://pinterest.com/pin/create/button/', 'only' => [ 'url' ] ],
        'reddit' => [ 'uri' => 'https://www.reddit.com/submit' ],
        'scoopit' => [ 'uri' => 'https://www.scoop.it/bookmarklet', 'only' => [ 'url' ] ],
        'telegramMe' => [ 'uri' => 'https://telegram.me/share/url', 'titleName' => 'text' ],
        'tumblr' => [ 'uri' => 'https://www.tumblr.com/widgets/share/tool', 'urlName' => 'canonicalUrl' ],
        'twitter' => [ 'uri' => 'https://twitter.com/intent/tweet', 'titleName' => 'text' ],
        'vk' => [ 'uri' => 'http://vk.com/share.php', 'mediaName' => 'image', 'extra' => [
            'noparse' => 'false',
        ]],
        'whatsapp' => [ 'view' => 'social-share::whatsapp' ],
    ],
];
