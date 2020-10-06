<?php

namespace App\Jobs;

use Embed\Embed;
use PHPHtmlParser\Dom;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GrahamCampbell\Markdown\Facades\Markdown;

class IndexArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Article $article;

    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    public function handle()
    {
        $embedMeta = [];
        $embedLinked = [];

        try {
            $embed = (new Embed())->get($this->article->url);
            $embedMeta = $embed->getMetas()->all();
            $embedLinked = $embed->getLinkedData()->all();
        } catch (\Throwable $th) {
            //
        }

        $dom = (new Dom())->loadStr($embed->getDocument());

        try {
            $banner = $dom->find('[alt="Image for post"]')->getAttribute('src');
        } catch (\Throwable $th) {
            $banner = null;
        }

        $contentOriginal = null;
        $contentMarkdown = null;
        $contentHtml = null;

        try {
            $contentOriginal = $dom->find('article')->innerHTML;
            $contentMarkdown = strip_tags((new HtmlConverter())->convert($contentOriginal));
            $contentHtml = Markdown::convertToHtml($contentMarkdown);
        } catch (\Throwable $th) {
            Log::debug($dom->innerHTML);
        }

        $this->article->update([
            'content_original'      => $contentOriginal,
            'content_original_html' => $this->applyModifiers($contentOriginal, 'content_original_html'),
            'content_markdown'      => $this->applyModifiers($contentMarkdown, 'content_markdown'),
            'content_markdown_html' => $this->applyModifiers($contentHtml, 'content_markdown_html'),
            'banner'                => str_replace('https://miro.medium.com/max/60/', 'https://cdn-images-1.medium.com/max/1200/', $banner),
            'embed_meta'            => json_encode($embedMeta),
            'embed_linked'          => json_encode($embedLinked),
        ]);
    }

    private function applyModifiers(?string $content, string $type): string
    {
        if (empty($content)) {
            return null;
        }

        $modifiers = config('mediumkit.modifiers.'.$type);

        foreach ($modifiers as $modifier) {
            $content = (new $modifier)->modify($content, $this->article->toArray());
        }

        return $content;
    }
}
