<?php

namespace App\Providers;

use App\Jobs\TwitterHandlerCrawlerJob;
use App\Services\InstrumentsExtractor;
use App\Services\TwitterClient;
use App\Services\TwitterClientInterface;
use App\Services\TwitterCrawler;
use App\Services\TwitterCrawlerInterface;
use App\Services\TwitterHTMLProcessor;
use App\Services\TwitterHTMLProcessorInterface;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TwitterCrawlerInterface::class, TwitterCrawler::class);
        $this->app->bind(TwitterClientInterface::class, TwitterClient::class);
        $this->app->bind(TwitterHTMLProcessorInterface::class, TwitterHTMLProcessor::class);
        $this->app->bindMethod([TwitterHandlerCrawlerJob::class, 'handle'], function (TwitterHandlerCrawlerJob $job, Application $app) {
            return $job->handle(
                $app->make(TwitterCrawlerInterface::class),
                $app->make(InstrumentsExtractor::class)
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
