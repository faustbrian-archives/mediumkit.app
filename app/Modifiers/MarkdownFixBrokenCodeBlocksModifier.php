<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class MarkdownFixBrokenCodeBlocksModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/```\s(```(.|\s)+?```)\s```/m', '$1', $content);
    }
}
