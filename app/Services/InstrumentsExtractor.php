<?php

namespace App\Services;

class InstrumentsExtractor
{
    private const PATTERN = '/\$[A-Z]+/';
    public function extract(string $text): array
    {
        preg_match_all(self::PATTERN, $text, $matches);
        return $matches[0];
    }
}
