<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class ConvertBreakingLineToNewLineModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/<br(\s+)?\/?>/i', "\n", $content);
    }
}
