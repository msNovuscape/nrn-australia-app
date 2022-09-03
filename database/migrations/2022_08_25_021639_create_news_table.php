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
            $table->integer('news_type');// 1 for NRNA self created news , 2 for third party news
            $table->string('image');
            $table->string('mobile_image')->nullable();
            $table->string('slug');
            $table->enum('status',['1','2']); // 1 for active , 2 for de-active
            $table->date('publish_date');
            $table->string('title');
            $table->enum('type',['1','2'])->default(1); //2 for feature types
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
