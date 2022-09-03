<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNrnaNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nrna_news', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('news_id')->unsigned();
            $table->foreign('news_id')->references('id')->on('news');
            $table->longText('description');
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->string('keyword')->nullable();
            $table->longText('meta_keyword')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('image_caption')->nullable();
            $table->string('image_credit')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nrna_news');
    }
}
