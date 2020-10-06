<?php

namespace App\Jobs;

use Embed\Embed;
use Carbon\Carbon;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Embed\Http\NetworkException;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use League\HTMLToMarkdown\HtmlConverter;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GrahamCampbell\Markdown\Facades\Markdown;

class IndexPostById implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 10;

    /**
     * The number of seconds to wait before retrying the job.
     *
     * @var int
     */
    public $backoff = 60;

    public string $postId;

    public string $postUrl;

    public function __construct(string $postId)
    {
        $this->postId = $postId;
        $this->postUrl = config('mediumkit.host').$this->postId;
    }

    public function handle()
    {
        $this->getRealUrl();

        try {
            $embed = (new Embed())->get($this->url);
            $embedMeta = $embed->getMetas()->all();
            $embedLinked = $embed->getLinkedData()->all();
        } catch (NetworkException $th) {
            return $this->release();
        }

        try {
            $article = Article::updateOrCreate(['uuid' => $this->postId], [
                'uuid'         => $this->postId,
                'title'        => $embedLinked['headline'],
                'author'       => $embedLinked['author']['name'],
                'author_link'  => $embedLinked['author']['url'],
                'excerpt'      => $embedLinked['description'],
                'url'          => $embedLinked['url'],
                'date'         => $embedLinked['datePublished'],
                'banner'       => head($embedLinked['image']),
                'embed_meta'   => $embedMeta,
                'embed_linked' => $embedLinked,
            ]);

            $dom = (new Dom())->loadStr($embed->getDocument());

            try {
                $contentOriginal = $dom->find('article')->innerHTML;
                $contentMarkdown = strip_tags((new HtmlConverter())->convert($contentOriginal));
                $contentHtml = Markdown::convertToHtml($contentMarkdown);

                $article->update([
                    'content_original'      => $contentOriginal,
                    'content_original_html' => $this->applyModifiers($article, 'content_original_html', $contentOriginal),
                    'content_markdown'      => $this->applyModifiers($article, 'content_markdown', $contentMarkdown),
                    'content_markdown_html' => $this->applyModifiers($article, 'content_markdown_html', $contentHtml),
                ]);
            } catch (\Throwable $th) {
                Log::debug([$this->postUrl, $th->getMessage()]);
            }
        } catch (\Throwable $th) {
            Log::debug([$this->postUrl, $th->getMessage()]);
        }
    }

    private function applyModifiers(Article $article, string $type, ?string $content): string
    {
        if (empty($content)) {
            return null;
        }

        $modifiers = config('mediumkit.modifiers.'.$type);

        foreach ($modifiers as $modifier) {
            $content = (new $modifier)->modify($content, $article->toArray());
        }

        return $content;
    }

    private function getRealUrl(): void
    {
        $this->client = new Client([
            'allow_redirects' => ['track_redirects' => true],
        ]);

        try {
            $response = $this->client->get($this->postUrl);

            $this->url = last($response->getHeader(\GuzzleHttp\RedirectMiddleware::HISTORY_HEADER));
        } catch (RequestException $th) {
            if ($th->getResponse()->getStatusCode() === 429) {
                $this->release();
            }
        }
    }
}
