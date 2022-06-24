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
        Schema::connection('mysql2')->dropIfExists('audit_parts');
        Schema::connection('mysql2')->create('audit_parts', function (Blueprint $table) {
            $table->id();
            $table->string('change_by');
            $table->string('activity')->nullable();            
            $table->string('recordid')->nullable();
            $table->string('sourcetable')->nullable();
            $table->longText('sourcefield')->nullable();
            $table->longText('beforevalue')->nullable();
            $table->longText('aftervalue')->nullable();
            $table->boolean('updated')->nullable()->default(0);    
            $table->datetime('inputsap_at')->nullable();      
            $table->string('updated_by')->nullable();        
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();          
            $table->index(['recordid']);           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('audit_parts');
    }
   
};
