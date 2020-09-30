<?php

namespace App\Jobs;

use Embed\Embed;
use PHPHtmlParser\Dom;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use League\HTMLToMarkdown\HtmlConverter;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GrahamCampbell\Markdown\Facades\Markdown;

class IndexArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $title;
    public $author;
    public $author_link;
    public $excerpt;
    public $url;
    public $date;

    public function __construct(array $article)
    {
        $this->title = $article['title'];
        $this->author = $article['author'];
        $this->author_link = $article['author_link'];
        $this->excerpt = $article['excerpt'];
        $this->url = strtok($article['url'], '?');
        $this->date = $article['date'];
    }

    public function handle()
    {
        $embed = (new Embed())->get($this->url);
        $dom = (new Dom())->loadStr($embed->getDocument());

        try {
            $banner = $dom->find('[alt="Image for post"]')->getAttribute('src');
        } catch (\Throwable $th) {
            $banner = null;
        }

        Article::upsert([
            'title'        => $this->title,
            'author'       => $this->author,
            'author_link'  => $this->author_link,
            'content'      => $content = strip_tags((new HtmlConverter())->convert($dom->find('article')->innerHTML)),
            'content_html' => Markdown::convertToHtml($content),
            'excerpt'      => $this->excerpt,
            'url'          => $this->url,
            'date'         => $this->date,
            'banner'       => str_replace('https://miro.medium.com/max/60/', 'https://cdn-images-1.medium.com/max/1200/', $banner),
            'embed_meta'   => json_encode($embed->getMetas()->all()),
            'embed_linked' => json_encode($embed->getLinkedData()->all()),
        ], ['url']);
    }
}
