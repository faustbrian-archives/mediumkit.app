<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveHeadingImagesModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/^\s*?(<img src="https:\/\/miro\.medium\.com\/max\/.+?")[^>]*(>)/', '', $content);
    }
}
