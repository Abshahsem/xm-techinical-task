<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tweet extends Model
{
    protected $fillable = ['handle_id', 'text', 'tweet_id','created_at'];

    public function instruments(): BelongsToMany
    {
        return $this->belongsToMany(Instrument::class, 'tweet_instrument', 'tweet_id', 'instrument_id');
    }

    public function handle(): BelongsTo
    {
        return $this->belongsTo(Handle::class);
    }
}
