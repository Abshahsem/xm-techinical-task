<?php

namespace App\Services;

interface TwitterClientInterface
{
    public function fetchTweets(string $handleId): ?string;
}
