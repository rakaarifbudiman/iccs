<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlpparentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flpparents', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->nullable();
            $table->datetime('date_input')->nullable(); 
            $table->string('code')->unique();
            $table->string('noflp')->nullable();
            $table->longText('documentname')->nullable();
            $table->longText('ingredients')->nullable();
            $table->string('dosageform')->nullable();
            $table->string('bussinessunit')->nullable();
            $table->string('flpstatus')->nullable();
            $table->string('packaging')->nullable();
            $table->string('regno')->nullable();
            $table->string('het')->nullable();
            $table->datetime('launch')->nullable();
            $table->string('detail')->nullable();            
            $table->string('inisiator')->nullable();
            $table->string('leader')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('approver')->nullable();
            $table->longText('notes1')->nullable();
            $table->longText('notes2')->nullable();
            $table->longText('notes')->nullable();
            $table->datetime('datesign_inisiator')->nullable();
            $table->datetime('datesign_leader')->nullable();
            $table->datetime('datesubmit_reviewer')->nullable();
            $table->datetime('datesubmit_approver')->nullable();
            $table->datetime('dateapproved')->nullable();
            $table->boolean('approved')->default(0);
            $table->longText('notes_closing')->nullable();
            $table->boolean('verified_a')->default(0);
            $table->boolean('verified_b')->default(0);
            $table->string('reviewer_closing')->nullable();
            $table->string('approver_closing')->nullable();
            $table->datetime('dateclosing_reviewer')->nullable(); 
            $table->datetime('dateclosing_approver')->nullable();
            $table->integer('extension_count')->nullable();    
            $table->integer('revision')->nullable()->default(0);        
            $table->longText('longtext1')->nullable();
            $table->longText('longtext2')->nullable();
            $table->longText('longtext3')->nullable();
            $table->string('text1')->nullable();
            $table->string('text2')->nullable();
            $table->string('text3')->nullable();
            $table->datetime('date1')->nullable(); 
            $table->datetime('date2')->nullable();
            $table->datetime('date3')->nullable(); 
            $table->datetime('date4')->nullable();            
            $table->timestamps();
            $table->index(['noflp']);
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flpparents');
    }
}
