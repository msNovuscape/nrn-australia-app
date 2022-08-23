<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class AddRelationBetweenUserAndMember extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            // $table->bigint('user_id');
            // $table->index('user_id');
            $table->foreignIdFor(User::class);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {

            
            $table->dropForeign(['user_id']);
            
            $table->dropColumn('user_id');

        });
    }
}
