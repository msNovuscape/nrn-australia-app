<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Member;
class CreateMemberDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Member::class);
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->string('identification_image');
            $table->date('identification_expiry_date');
            $table->string('proof_of_residency_image');
            $table->date('proof_of_residency_expiry_date');
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
        Schema::dropIfExists('member_documents');
    }
}
