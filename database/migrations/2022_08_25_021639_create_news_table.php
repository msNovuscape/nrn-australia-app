<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->integer('news_type')->nullable();
            $table->string('image');
            $table->string('image_alt');
            $table->longText('description');
            $table->longText('middle_description')->nullable();
            $table->longText('bottom_description')->nullable();
            $table->string('seo_title')->nullable();
            $table->longText('seo_description')->nullable();
            $table->string('keyword')->nullable();
            $table->string('slug');
            $table->longText('meta_keyword')->nullable();
            $table->enum('status',['1','2']); // 1 for active , 2 for de-active
            $table->date('publish_date');
            $table->string('title');
            $table->string('point_title')->nullable();
            $table->string('image_credit')->nullable();
            $table->string('author')->nullable();
            $table->string('image_caption')->nullable();
            $table->enum('type',['1','2']); //1 for blog, 2 for featured bogs
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
        Schema::dropIfExists('news');
    }
}
