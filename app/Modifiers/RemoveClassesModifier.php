<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveClassesModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace("|class=\\\"([^']*?)\\\"|", '', $content);
    }
}
