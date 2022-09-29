<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->integer('notice_type');// 1 for NRNA self created news , 2 for third party news
            $table->string('image')->nullable();
            $table->string('mobile_image')->nullable();
            $table->string('slug');
            $table->enum('status',['1','2']); // 1 for active , 2 for de-active
            $table->date('publish_date');
            $table->string('title');
            $table->string('excerpt')->nullable(); //short seo description
            $table->enum('type',['1','2'])->default(1)->nullable(); //1 for feature types
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
        Schema::dropIfExists('notices');
    }
}
