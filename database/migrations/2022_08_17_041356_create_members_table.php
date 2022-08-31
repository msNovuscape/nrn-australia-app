<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\MembershipType;

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
            $table->integer('state_id');
            $table->integer('country_id');
            $table->string('postcode');
            $table->string('mobile_number');
            $table->string('email');
            $table->integer('gender_id');
            $table->foreignIdFor(MembershipType::class);
            $table->foreign('membership_type_id')->references('id')->on('membership_types')->onDelete('cascade');
            $table->integer('membership_status_id')->default(1);
            $table->integer('payment_status_id')->default(1);
            $table->dateTime('membership_issued_date')->nullable();
            $table->dateTime('membership_expiry_date')->nullable();
            $table->string('region_id');
            $table->string('occupation')->nullable();
            $table->integer('eligibility_type_id');
            $table->string('image');
            $table->boolean('status')->default(true);
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
