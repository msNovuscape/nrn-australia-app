<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Member;
class CreateVerifyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('verify_users', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class)->nullable();
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('email');
            $table->string('code');
            $table->boolean('is_verified')->default(false);
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
        Schema::dropIfExists('verify_users');
    }
}
