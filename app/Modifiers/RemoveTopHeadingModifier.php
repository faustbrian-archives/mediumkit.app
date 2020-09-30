<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveTopHeadingModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return str_replace('<h1>'.$article['title'].'</h1>', '', $content);
    }
}
