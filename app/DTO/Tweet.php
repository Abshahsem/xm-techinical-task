<?php

namespace App\DTO;

readonly class Tweet
{
    public function __construct(
        private string $id,
        private string $text,
    ) {

    }

    public function getId(): string
    {
        return $this->id;
    }
    public function getText(): string
    {
        return '#1 Crypto trading community hands down.
http://cryptotraders.is-great.net
$SHIB $ETH $ADA $ADNAN $DOT $XRP $LTC $LINK $UNI $XEM $FLOK';
    }
}
