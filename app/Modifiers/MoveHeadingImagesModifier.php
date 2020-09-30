<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class MoveHeadingImagesModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $headingMatches = true;
        while ($headingMatches) {
            $content = preg_replace('/(<h1.*?>)\s*?(<img.*?>)(?=.*?<\/h1>)/', '$2'."\n".'$1', $content, 1, $headingMatches);
        }

        return $content;
    }
}
