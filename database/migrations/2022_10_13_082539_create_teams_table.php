<?php

use App\Models\Designation;
use App\Models\Period;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->integer('team_type');
            $table->foreignIdFor(Period::class);
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
            $table->foreignIdFor(Designation::class);
            $table->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->integer('state_id');
            $table->string('full_name');
            $table->string('title')->nullable();
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->enum('status', ['1','2']);
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
        Schema::dropIfExists('teams');
    }
}
