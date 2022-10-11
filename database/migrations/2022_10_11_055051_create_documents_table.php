<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DocumentCategory;
use App\Models\Period;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(DocumentCategory::class);
            $table->foreign('document_category_id')->references('id')->on('document_categories')->onDelete('cascade');
            $table->foreignIdFor(Period::class);
            $table->foreign('period_id')->references('id')->on('periods')->onDelete('cascade');
            $table->string('title');
            $table->string('file');
            $table->string('description')->nullable();
            $table->string('publish_date')->nullable();
            $table->enum('status',['1','2']);
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
        Schema::dropIfExists('documents');
    }
}
