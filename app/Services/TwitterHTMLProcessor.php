<?php

namespace App\Services;


use App\DTO\Tweet;

class TwitterHTMLProcessor implements TwitterHTMLProcessorInterface
{

    public function process(string $html): array
    {
        $results = [];
        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $tweets = $dom->getElementsByTagName('div');
        foreach ($tweets as $tweet) {
            if ($tweet->getAttribute('data-testid') === 'tweetText') {
                $tweetId = $tweet->getAttribute('id');
                $tweetText = $tweet->textContent;
                $results[] = new Tweet($tweetId, $tweetText);
            }
        }
        return $results;
    }
}
