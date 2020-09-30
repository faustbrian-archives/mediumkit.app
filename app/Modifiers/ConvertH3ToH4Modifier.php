<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class ConvertH3ToH4Modifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return str_replace(['<h3', '</h3>'], ['<h4', '</h4>'], $content);
    }
}
