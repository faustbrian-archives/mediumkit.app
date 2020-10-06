<?php

namespace App\Console\Commands;

use PHPHtmlParser\Dom;
use App\Models\Article;
use Illuminate\Console\Command;
use League\HTMLToMarkdown\HtmlConverter;
use GrahamCampbell\Markdown\Facades\Markdown;

class ProcessArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (Article::all() as $article) {
            $contentOriginal = $article->content_original;
            $contentMarkdown = strip_tags((new HtmlConverter())->convert($contentOriginal));
            $contentHtml = Markdown::convertToHtml($contentMarkdown);

            $article->update([
                'content_original_html' => $this->applyModifiers($article, $contentOriginal, 'content_original_html'),
                'content_markdown'      => $this->applyModifiers($article, $contentMarkdown, 'content_markdown'),
                'content_markdown_html' => $this->applyModifiers($article, $contentHtml, 'content_markdown_html'),
            ]);
        }
    }

    private function applyModifiers(Article $article, string $content, string $type): string
    {
        $modifiers = config('mediumkit.modifiers.'.$type);

        foreach ($modifiers as $modifier) {
            $content = (new $modifier)->modify($content, $article->toArray());
        }

        return $content;
    }
}
