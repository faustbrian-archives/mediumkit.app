<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveRetweetLinkModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/<p.*?><a href="https:\/\/twitter\.com.*?Retweet.*?(- - - - - -)<\/p>\n/', '', $content);
    }
}
