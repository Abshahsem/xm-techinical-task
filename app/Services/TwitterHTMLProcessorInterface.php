<?php

namespace App\Services;

interface TwitterHTMLProcessorInterface
{
    public function process(string $html): array;
}
