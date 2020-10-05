<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveHorizontalRuleModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/<hr.*?>\s*/', '', $content);
    }
}
