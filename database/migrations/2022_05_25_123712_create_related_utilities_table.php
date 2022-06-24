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
        Schema::create('related_utilities', function (Blueprint $table) {
            $table->id();
            $table->timestamps();            
            $table->string('code')->nullable();            
            $table->string('area')->nullable();
            $table->string('description')->nullable();              
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
        Schema::dropIfExists('related_utilities');
    }
};
