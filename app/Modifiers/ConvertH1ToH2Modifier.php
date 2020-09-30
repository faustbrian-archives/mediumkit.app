<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class ConvertH1ToH2Modifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return str_replace(['<h1', '</h1>'], ['<h2', '</h2>'], $content);
    }
}
