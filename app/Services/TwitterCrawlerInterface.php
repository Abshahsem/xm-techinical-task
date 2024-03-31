<?php

namespace App\Services;

interface TwitterCrawlerInterface
{
    public function crawl(string $handleId): array;
}
