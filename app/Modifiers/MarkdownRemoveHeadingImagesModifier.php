<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class MarkdownRemoveHeadingImagesModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $imageMatches = true;
        while ($imageMatches) {
            $content = preg_replace('/^\s*!\[\]\(https:\/\/miro\.medium\.com\/max.+?\)/', '', $content, 1, $imageMatches);
        }

        return $content;
    }
}
