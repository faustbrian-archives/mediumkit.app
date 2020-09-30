<?php

use App\Modifiers\RemoveAuthorBlockModifier;
use App\Modifiers\RemoveTopHeadingModifier;
use App\Modifiers\MoveHeadingImagesModifier;
use App\Modifiers\MoveParagraphImagesModifier;
use App\Modifiers\RemoveSmallOrMissingImagesModifier;
use App\Modifiers\RemoveHeadingImagesModifier;
use App\Modifiers\RemoveHorizontalRuleModifier;
use App\Modifiers\RemoveTopTweetModifier;
use App\Modifiers\RemoveListItemParagraphsModifier;

return [

    'modifiers' => [

        'content_original' => [],

        'content_markdown' => [],

        'content_html' => [
            RemoveTopHeadingModifier::class,
            RemoveAuthorBlockModifier::class,
            MoveHeadingImagesModifier::class,
            MoveParagraphImagesModifier::class,
            RemoveSmallOrMissingImagesModifier::class,
            RemoveHeadingImagesModifier::class,
            RemoveHorizontalRuleModifier::class,
            RemoveTopTweetModifier::class,
            RemoveListItemParagraphsModifier::class,
        ],

    ]

];
