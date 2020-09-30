<?php

namespace App\Jobs;

use PHPHtmlParser\Dom;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class IndexMonth implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public string $host;
    public int $year;
    public int $month;

    public function __construct(string $host, int $year, int $month)
    {
        $this->host = $host;
        $this->year = $year;
        $this->month = $month;
    }

    public function handle()
    {
        $month = sprintf('%02d', $this->month);
        $response = Http::get("{$this->host}/archive/{$this->year}/{$month}")->body();

        $dom = new Dom();
        $dom->loadStr($response);

        foreach ($dom->find('.postArticle--short') as $row) {
            $results[] = IndexArticle::dispatch([
                'title'       => $row->find('.graf--h3')->innerText,
                'author'      => $row->find('.ds-link--styleSubtle')->innerText,
                'author_link' => $row->find('.ds-link--styleSubtle')->getAttribute('href'),
                'excerpt'     => $row->find('.postArticle-content')->innerText,
                'url'         => $row->find('.button--chromeless')->getAttribute('href'),
                'date'        => $row->find('time')->getAttribute('datetime'),
            ]);
        }
    }
}
