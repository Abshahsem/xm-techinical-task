<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Instrument extends Model
{
    protected $fillable = ['name'];

    public function tweets(): BelongsToMany
    {
        return $this->belongsToMany(Tweet::class, 'tweet_instrument', 'instrument_id', 'tweet_id');
    }


}

