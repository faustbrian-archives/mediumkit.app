<?php

namespace App\Modifiers;

use App\Contracts\Modifier;

class ConvertPreSpanToPreCodeModifier implements Modifier
{
    public function modify(string $content, array $article): string
    {
        $content = str_replace(
            '<pre><span>',
            '<div class="p-4 mb-6 rounded-lg bg-theme-secondary-800 overflow-x-auto"><pre class="hljs"><code class="hljs-copy language-javascript">',
            $content
        );

        $content = str_replace('</span></pre>', '</code></pre></div>', $content);

        return $content;
    }
}
