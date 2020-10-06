<?php

namespace App\Jobs;

use PHPHtmlParser\Dom;
use App\Models\Article;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class IndexArchiveByDay implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $host;

    public int $year;

    public int $month;

    public int $day;

    public function __construct(string $host, int $year, int $month, int $day)
    {
        $this->host = $host;
        $this->year = $year;
        $this->month = $month;
        $this->day = $day;
    }

    public function handle()
    {
        $month = sprintf('%02d', $this->month);
        $day = sprintf('%02d', $this->day);
        $response = Http::get("{$this->host}/archive/{$this->year}/{$month}/{$day}")->body();

        $dom = new Dom();
        $dom->loadStr($response);

        foreach ($dom->find('.postArticle--short') as $row) {
            $article = Article::upsert([
                'title'       => $row->find('.graf--h3')->innerText,
                'author'      => $row->find('.ds-link--styleSubtle')->innerText,
                'author_link' => $row->find('.ds-link--styleSubtle')->getAttribute('href'),
                'excerpt'     => $row->find('.postArticle-content')->innerText,
                'url'         => strtok($row->find('.button--chromeless')->getAttribute('href'), '?'),
                'date'        => $row->find('time')->getAttribute('datetime'),
            ], ['url']);

            // IndexArticle::dispatch($article);
        }
    }

    public function tags()
    {
        return ['archive', 'year:'.$this->year, 'month:'.$this->month, 'day:'.$this->day];
    }
}
