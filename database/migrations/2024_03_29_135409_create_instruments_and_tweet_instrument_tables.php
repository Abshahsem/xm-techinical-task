<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('instruments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('tweet_instrument', function (Blueprint $table) {
            $table->foreignId('tweet_id')->constrained('tweets');
            $table->foreignId('instrument_id')->constrained('instruments');
            $table->primary(['tweet_id', 'instrument_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweet_instrument');
        Schema::dropIfExists('instruments');
    }
};
