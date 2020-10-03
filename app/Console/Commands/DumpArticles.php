<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class DumpArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dump:articles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump Articles as JSON';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $articles = Article::get()->unique('title');

        file_put_contents(base_path('medium.json'), $articles->toJson());

        foreach ($articles as $article) {
            file_put_contents(base_path('articles/'.Str::slug($article->title).'.html'), $article->content_original_html);
        }
    }
}
