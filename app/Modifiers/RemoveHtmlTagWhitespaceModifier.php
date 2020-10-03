<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveHtmlTagWhitespaceModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $content = preg_replace('(\s+>)', '>', $content);
        $content = preg_replace('/\>\s+\</m', '><', $content);

        return $content;
    }
}
