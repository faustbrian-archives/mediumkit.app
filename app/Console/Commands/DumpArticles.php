<?php

namespace App\Console\Commands;

use App\Models\Article;
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
        file_put_contents(base_path('medium.json'), Article::get()->unique('title')->toJson());
    }
}
