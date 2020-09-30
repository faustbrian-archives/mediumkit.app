<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveTopTweetModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/<h1.*?>TOP TWEET<\/h1>\n/', '', $content);
    }
}
