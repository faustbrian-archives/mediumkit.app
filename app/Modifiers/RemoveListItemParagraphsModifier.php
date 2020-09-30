<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class RemoveListItemParagraphsModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        return preg_replace(['/(<li.*?>)\s*?<p>/', '/<\/p>\s*?<\/li>/'], ['$1', '</li>'], $content);
    }
}
