<?php

namespace App\Console\Commands;

use App\Jobs\TwitterHandlerCrawlerJob;
use App\Models\Handle;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScheduleTweetsCrawling extends Command
{
    protected $signature = 'schedule:twitter-crawling';
    protected $description = 'Schedule crawling tweets from predefined handles';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $handles = Handle::all();
        foreach ($handles as $handle) {
            if ($handle->last_crawled_at === null ||
                Carbon::create($handle->last_crawled_at)
                    ->addMinutes((int)$handle->crawl_frequency)->isPast()) {
                // Dispatch the TwitterHandlerCrawlerJob
                TwitterHandlerCrawlerJob::dispatch($handle);

                // Update the last_crawled_at timestamp to now
                $handle->last_crawled_at = Carbon::now()->timestamp(time());
                $handle->save();
            }
        }
    }
}
