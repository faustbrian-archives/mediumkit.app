<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveBloatMarkupModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $content = str_replace('<section></section>', '', $content);
        $content = str_replace('<div></div>', '', $content);
        $content = str_replace('<span></span>', '', $content);
        $content = str_replace('<p></p>', '', $content);

        return $content;
    }
}
