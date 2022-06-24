<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('related_documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();            
            $table->string('code')->nullable();            
            $table->string('type')->nullable();
            $table->string('doc_number')->nullable();
            $table->string('doc_title')->nullable();               
            $table->string('uploader')->nullable();            
            $table->datetime('deleted_at')->nullable();   
            $table->index(['code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('related_documents');
    }
};
