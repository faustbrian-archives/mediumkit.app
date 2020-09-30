<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveAuthorBlockModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace('/<a href="\/@.+?">.+?(min read).+?<\/a>/', '', $content);
    }
}
