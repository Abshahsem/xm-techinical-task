<?php

namespace App\Jobs;

use App\Models\Handle;
use App\Models\Instrument;
use App\Models\Tweet;
use App\Services\InstrumentsExtractor;
use App\Services\TwitterCrawlerInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class TwitterHandlerCrawlerJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Handle $handle;

    /**
     * Create a new job instance.
     */
    public function __construct(Handle $handle)
    {
        $this->handle = $handle->withoutRelations();
    }

    /**
     * Execute the job.
     */
    public function handle(
        TwitterCrawlerInterface $crawler,
        InstrumentsExtractor $instrumentsExtractor,
    ): void {
        /** @var array<\App\DTO\Tweet> $tweets */
        $tweets = $crawler->crawl($this->handle->name);
        foreach ($tweets as $tweet) {
            $alreadyExists = Tweet::where('tweet_id', '=', $tweet->getId());
            if ($alreadyExists) {
                continue;
            }
            $instruments = $instrumentsExtractor->extract($tweet->getText());
            if (empty($instruments)) {
                continue;
            }
            $tweetModel = new Tweet();
            $tweetModel->text = $tweet->getText();
            $tweetModel->tweet_id = $tweet->getId();
            $tweetModel->handle_id = $this->handle->id;
            $tweetModel->save();
            foreach ($instruments as $instrumentName) {
                $instrument = Instrument::where('name', '=', $instrumentName)->first();
                if (!$instrument) {
                    $instrument = new Instrument();
                    $instrument->name = $instrumentName;
                    $instrument->save();
                }
                $instrument->tweets()->save($tweetModel);
                $instrument->save();
            }
        }
    }
}
