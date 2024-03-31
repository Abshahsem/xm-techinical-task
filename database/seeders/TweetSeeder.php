<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TweetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('handles')->insert([
            'id' => 2,
            'name' => 'financial-account-name'
        ]);
        DB::table('tweets')->insert([
            [
                'id' => 100,
                'text' => '$BTC',
                'handle_id' => 2,
                'tweet_id' => "id_1"
            ],
            [
                'id' => 101,
                'text' => '$BTC',
                'handle_id' => 2,
                'tweet_id' => "id_2"
            ], [
                'id' => 102,
                'text' => '$BTC',
                'handle_id' => 2,
                'tweet_id' => "id_3"
            ], [
                'id' => 103,
                'text' => '$BTC',
                'handle_id' => 2,
                'tweet_id' => "id_4"
            ], [
                'id' => 104,
                'text' => '$BTC',
                'handle_id' => 2,
                'tweet_id' => "id_5"
            ], [
                'id' => 105,
                'text' => '$SHIBA',
                'handle_id' => 2,
                'tweet_id' => "id_6"
            ], [
                'id' => 106,
                'text' => '$SHIBA',
                'handle_id' => 2,
                'tweet_id' => "id_7"
            ], [
                'id' => 107,
                'text' => '$SHIBA',
                'handle_id' => 2,
                'tweet_id' => "id_8"
            ], [
                'id' => 108,
                'text' => '$SHIBA',
                'handle_id' => 2,
                'tweet_id' => "id_9"
            ], [
                'id' => 109,
                'text' => '$SHIBA',
                'handle_id' => 2,
                'tweet_id' => "id_10"
            ], [
                'id' => 110,
                'text' => '$SHIBA',
                'handle_id' => 2,
                'tweet_id' => "id_11"
            ]

        ]);

        DB::table('instruments')->insert([
            [
                'id' => 1,
                'name' => '$SHIBA'
            ],
            [
                'id' => 2,
                'name' => '$BTC'
            ]
        ]);

        DB::table('tweet_instrument')->insert([
            [
                'tweet_id' => 100,
                'instrument_id' => 2
            ], [
                'tweet_id' => 101,
                'instrument_id' => 2
            ], [
                'tweet_id' => 102,
                'instrument_id' => 2
            ], [
                'tweet_id' => 103,
                'instrument_id' => 2
            ], [
                'tweet_id' => 104,
                'instrument_id' => 2
            ], [
                'tweet_id' => 105,
                'instrument_id' => 1
            ], [
                'tweet_id' => 106,
                'instrument_id' => 1
            ], [
                'tweet_id' => 107,
                'instrument_id' => 2
            ], [
                'tweet_id' => 108,
                'instrument_id' => 2
            ], [
                'tweet_id' => 109,
                'instrument_id' => 2
            ], [
                'tweet_id' => 110,
                'instrument_id' => 2
            ],
        ]);
    }
}
