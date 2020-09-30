<?php

use App\Modifiers\RemoveAuthorBlockModifier;
use App\Modifiers\RemoveTopHeadingModifier;

return [

    'modifiers' => [

        'content_original' => [],

        'content_markdown' => [],

        'content_html' => [
            RemoveTopHeadingModifier::class,
            RemoveAuthorBlockModifier::class,
        ],

    ]

];
