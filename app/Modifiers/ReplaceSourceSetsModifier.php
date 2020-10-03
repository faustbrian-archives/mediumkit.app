<?php

namespace App\Modifiers;

use PHPHtmlParser\Dom;
use PHPHtmlParser\Dom\Tag;
use App\Contracts\Modifier;

class ReplaceSourceSetsModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $content = (new Dom())->loadStr($content);

        foreach ($content->find('img') as $image) {
            $image->setTag((new Tag('img'))->setAttribute('src', str_replace('max/60', 'max/1280', $image->getAttribute('src'))));
        }

        return $content->innerHTML;
    }
}
