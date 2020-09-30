<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class MoveParagraphImagesModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $paragraphMatches = true;
        while ($paragraphMatches) {
            $content = preg_replace('/(<p.*?>)\s*?(<img.*?>)(?=.*?<\/p>)/', '$2'."\n".'$1', $content, 1, $paragraphMatches);
        }

        return $content;
    }
}
