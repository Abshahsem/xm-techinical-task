<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Handle extends Model
{
    protected $fillable = ['name', 'crawl_frequency', 'last_crawled_at'];

    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class);
    }
}
