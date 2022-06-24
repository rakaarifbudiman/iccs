<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditflpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditflps', function (Blueprint $table) {
            $table->id();
            $table->string('change_by');
            $table->string('activity')->nullable();            
            $table->string('recordid')->nullable();
            $table->string('sourcetable')->nullable();
            $table->string('sourcefield')->nullable();
            $table->longText('beforevalue')->nullable();
            $table->longText('aftervalue')->nullable();
            $table->longText('notes')->nullable();        
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
        Schema::dropIfExists('auditflps');
    }
}
