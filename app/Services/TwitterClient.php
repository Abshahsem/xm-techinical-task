<?php

namespace App\Services;

use GuzzleHttp\Client;
use HeadlessChromium\BrowserFactory;
use HeadlessChromium\Page;

class TwitterClient implements TwitterClientInterface
{

    public function __construct(Client $client)
    {

    }

    public function fetchTweets(string $handleId): ?string
    {
        $url = sprintf("https://twitter.com/%s?lang=en", $handleId);
        try {
            $browserFactory = new BrowserFactory();
            $browser = $browserFactory->createBrowser([
                'userAgent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Safari/537.36',
            ]);
            $page = $browser->createPage();
            $page->navigate($url)->waitForNavigation(Page::NETWORK_IDLE, 60000);
            $eval = $page->evaluate('document.documentElement.innerHTML');
            return $eval->getReturnValue(60000);
        } catch (\Exception $exception) {
//            throw $exception;
        }
        return null;
    }

}
