<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class ConvertPreSpanToPreCodeModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $content = str_replace('<pre><span>', '<pre><code class="language-javascript">', $content);
        $content = str_replace('</span></pre>', '</code></pre>', $content);

        return $content;
    }
}
