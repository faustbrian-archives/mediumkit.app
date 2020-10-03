<?php

namespace App\Modifiers;

use PHPHtmlParser\Dom;
use App\Contracts\Modifier;

class RemoveAuthorHeaderModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $dom = (new Dom())->loadStr($content);

        // Author & Social Media
        $dom->find('section > div > div > div')[0]->delete();

        // Dead Block
        $dom->find('section')[0]->delete();

        // Outro
        if ($dom->find('section')[1]) {
            $dom->find('section')[1]->delete();
        }

        return $dom->innerHTML;
    }
}
