<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('dob');
            $table->string('residental_address');
            $table->string('suburb');
            $table->string('state_id');
            $table->string('country_id');
            $table->string('postcode');
            $table->string('mobile_number');
            $table->string('email');
            $table->string('gender_id');
            $table->string('membership_type_id');
            $table->string('region_id');
            $table->string('occupation')->nullable();
            $table->string('password');
            $table->string('eligibility_type_id');
            $table->string('image');
            $table->softDeletes();
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
        Schema::dropIfExists('members');
    }
}