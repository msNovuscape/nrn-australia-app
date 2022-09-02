<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\EligibilityType;
use App\Models\MembershipType;


class CreateEligibilityTypeMembershipTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eligibility_type_membership_type', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EligibilityType::class);
            $table->foreign('eligibility_type_id')->references('id')->on('eligibility_types')->onDelete('cascade');
            $table->foreignIdFor(MembershipType::class);
            $table->foreign('membership_type_id')->references('id')->on('membership_types')->onDelete('cascade');            
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
        Schema::dropIfExists('eligibility_type_membership_type');
    }
}
