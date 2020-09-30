<?php

namespace App\Contracts;

interface Modifier
{
    public function modify(string $content, array $article): string;
}
