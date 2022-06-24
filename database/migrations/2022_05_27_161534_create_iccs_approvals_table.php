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
        Schema::create('approvals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();    
            $table->string('code')->nullable();            
            $table->string('type')->nullable();
            $table->string('username')->nullable();
            $table->string('note')->nullable();               
            $table->boolean('active')->nullable();            
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
        Schema::dropIfExists('approvals');
    }
};
