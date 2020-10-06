<?php

namespace App\Console\Commands;

use App\Jobs\IndexArchiveByDay;
use Illuminate\Console\Command;

class IndexArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'index:articles {--host=} {--start=} {--end=}';

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
        $years = [];

        foreach (range($this->option('start'), $this->option('end')) as $year) {
            $years[$year] = range(1, 12);
        }

        foreach ($years as $year => $months) {
            foreach ($months as $month) {
                foreach (range(1, 31) as $day) {
                    IndexArchiveByDay::dispatch($this->option('host'), $year, $month, $day);
                }
            }
        }
    }
}
