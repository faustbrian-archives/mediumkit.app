<?php

use App\Modifiers\RemoveAuthorBlockModifier;
use App\Modifiers\RemoveTopHeadingModifier;
use App\Modifiers\MoveHeadingImagesModifier;
use App\Modifiers\MoveParagraphImagesModifier;
use App\Modifiers\RemoveSmallOrMissingImagesModifier;
use App\Modifiers\RemoveHeadingImagesModifier;
use App\Modifiers\RemoveHorizontalRuleModifier;
use App\Modifiers\RemoveTopTweetModifier;
use App\Modifiers\RemoveRetweetLinkModifier;
use App\Modifiers\RemoveListItemParagraphsModifier;
use App\Modifiers\ConvertH3ToH4Modifier;
use App\Modifiers\ConvertH2ToH3Modifier;
use App\Modifiers\ConvertH1ToH2Modifier;
use App\Modifiers\RemoveBloatMarkupModifier;
use App\Modifiers\RemoveClassesModifier;
use App\Modifiers\RemoveHtmlTagWhitespaceModifier;
use App\Modifiers\RemoveIdsModifier;

return [

    'modifiers' => [

        'content_original' => [
            RemoveClassesModifier::class,
            RemoveIdsModifier::class,
            RemoveHtmlTagWhitespaceModifier::class,
            RemoveBloatMarkupModifier::class,
            ConvertPreSpanToPreCodeModifier::class,
        ],

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
            RemoveRetweetLinkModifier::class,
            RemoveListItemParagraphsModifier::class,
            ConvertH3ToH4Modifier::class,
            ConvertH2ToH3Modifier::class,
            ConvertH1ToH2Modifier::class,
        ],

    ]

];
