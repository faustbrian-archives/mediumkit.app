<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveIdsModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace("|id=\\\"([^']*?)\\\"|", '', $content);
    }
}
