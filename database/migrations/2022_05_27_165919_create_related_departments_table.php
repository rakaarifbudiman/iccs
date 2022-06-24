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
        Schema::create('related_departments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('code')->nullable();            
            $table->string('approval_code')->nullable();
            $table->string('username')->nullable();
            $table->string('department')->nullable();
            $table->datetime('signdate')->nullable(); 
            $table->longText('note')->nullable();     
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
        Schema::dropIfExists('related_departments');
    }
};
