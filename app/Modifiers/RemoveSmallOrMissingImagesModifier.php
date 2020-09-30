<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveSmallOrMissingImagesModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/(<img src="(https:\/\/miro\.medium\.com\/max\/(([0-9]{2})|2456)\/.+?)?")[^>]*(>)/', '', $content);
    }
}
