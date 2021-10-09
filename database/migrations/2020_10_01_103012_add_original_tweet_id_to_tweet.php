<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOriginalTweetIdToTweet extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->unsignedBigInteger('original_tweet_id')->index()->nullable();
            $table->foreign('original_tweet_id')->references('id')->on('tweets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tweets', function (Blueprint $table) {
            $table->dropForeign(['original_tweet_id']);
            $table->dropColumn('original_tweet_id');

        });
    }
}
