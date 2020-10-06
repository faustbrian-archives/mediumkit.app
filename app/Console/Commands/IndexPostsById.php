<?php

namespace App\Console\Commands;

use App\Jobs\IndexPostById;
use Illuminate\Console\Command;

class IndexPostsById extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts-by-id';

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
        $postIds = config('mediumkit.postIds');

        foreach ($postIds as $postId) {
            IndexPostById::dispatch($postId)->delay(now()->addSeconds(10));
        }
    }
}
