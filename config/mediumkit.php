<?php

use App\Modifier\RemoveTopHeadingModifier;

return [

    'modifiers' => [

        'content_original' => [],

        'content_markdown' => [],

        'content_html' => [
            RemoveTopHeadingModifier::class,
        ],

    ]

];
