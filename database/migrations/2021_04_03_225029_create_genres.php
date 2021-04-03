<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGenres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_genres', function (Blueprint $table) {
            // varchar(100): 文字列型, primarykey:プライマリーキー, not null
            $table->string('genre_code', 100)->nullable(false)->primary('genre_code');	
            // varchar(100): 文字列型
            $table->string('title', 100)->nullable(false);	
            // varchar(100): 文字列型
            $table->string('image1', 100)->nullable();	
            // datetime：
            $table->dateTime('created_at')->nullable();	
            $table->dateTime('updated_at')->nullable();	
            $table->dateTime('deleted_at')->nullable();	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('m_genres');
    }
}
