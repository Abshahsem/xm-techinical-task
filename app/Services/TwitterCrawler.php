<?php

namespace App\Services;

readonly class TwitterCrawler implements TwitterCrawlerInterface
{
    public function __construct(
        private TwitterClientInterface $client,
        private TwitterHTMLProcessorInterface $twitterHTMLProcessor,
    ) {
    }

    public function crawl(string $handleId): array
    {
        $html = $this->client->fetchTweets($handleId);
        if (null === $html) {
            return [];
        }
        return $this->twitterHTMLProcessor->process($html);
    }
}
