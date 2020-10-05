<?php

use App\Modifiers\RemoveIdsModifier;
use App\Modifiers\ConvertH1ToH2Modifier;
use App\Modifiers\ConvertH2ToH3Modifier;
use App\Modifiers\ConvertH3ToH4Modifier;
use App\Modifiers\RemoveClassesModifier;
use App\Modifiers\RemoveTopTweetModifier;
use App\Modifiers\RemoveTopHeadingModifier;
use App\Modifiers\MoveHeadingImagesModifier;
use App\Modifiers\RemoveAuthorBlockModifier;
use App\Modifiers\RemoveBloatMarkupModifier;
use App\Modifiers\RemoveRetweetLinkModifier;
use App\Modifiers\ReplaceSourceSetsModifier;
use App\Modifiers\RemoveAuthorHeaderModifier;
use App\Modifiers\MoveParagraphImagesModifier;
use App\Modifiers\RemoveHeadingImagesModifier;
use App\Modifiers\RemoveHorizontalRuleModifier;
use App\Modifiers\ConvertPreSpanToPreCodeModifier;
use App\Modifiers\RemoveHtmlTagWhitespaceModifier;
use App\Modifiers\RemoveListItemParagraphsModifier;
use App\Modifiers\RemoveSmallOrMissingImagesModifier;
use App\Modifiers\ConvertBreakingLineToNewLineModifier;
use App\Modifiers\MarkdownRemoveHeadingImagesModifier;
use App\Modifiers\MarkdownRemoveHorizontalRuleModifier;

return [

    'modifiers' => [

        'content_original_html' => [
            // Clean up obfuscation junk.
            RemoveClassesModifier::class,
            RemoveIdsModifier::class,
            RemoveHtmlTagWhitespaceModifier::class,
            // Fix/Clean HTML Markup
            ConvertPreSpanToPreCodeModifier::class,
            // RemoveTopHeadingModifier::class,
            RemoveAuthorHeaderModifier::class,
            // // MoveHeadingImagesModifier::class,
            // // MoveParagraphImagesModifier::class,
            ReplaceSourceSetsModifier::class,
            RemoveSmallOrMissingImagesModifier::class,
            RemoveHeadingImagesModifier::class,
            RemoveHorizontalRuleModifier::class,
            RemoveTopTweetModifier::class,
            RemoveRetweetLinkModifier::class,
            // RemoveListItemParagraphsModifier::class,
            ConvertH3ToH4Modifier::class,
            ConvertH2ToH3Modifier::class,
            ConvertH1ToH2Modifier::class,
            ConvertBreakingLineToNewLineModifier::class,
            // Remove dead elements without any contents after we cleaned up.
            RemoveBloatMarkupModifier::class,
        ],

        'content_markdown' => [
            MarkdownRemoveHeadingImagesModifier::class,
            MarkdownRemoveHorizontalRuleModifier::class,
        ],

        'content_markdown_html' => [
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
