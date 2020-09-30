<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class ConvertH2ToH3Modifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return str_replace(['<h2', '</h2>'], ['<h3', '</h3>'], $content);
    }
}
