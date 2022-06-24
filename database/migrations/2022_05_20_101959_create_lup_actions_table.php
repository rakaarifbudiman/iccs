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
        Schema::create('lup_actions', function (Blueprint $table) {
            $table->id();            
            $table->string('code')->nullable();
            $table->string('noaction')->nullable();
            $table->string('action')->nullable();            
            $table->string('pic_action')->nullable();
            $table->datetime('duedate_action')->nullable();
            $table->datetime('signdate_action')->nullable();
            $table->string('evidence_filename')->nullable();
            $table->string('evidence_uploader')->nullable();
            $table->datetime('dateupload_evidence')->nullable();
            $table->string('evidence_approver')->nullable();
            $table->datetime('dateapproved_evidence')->nullable();
            $table->string('pic_extension')->nullable();
            $table->string('reviewer_extension')->nullable();
            $table->string('approver_extension')->nullable();
            $table->datetime('signdate_extension')->nullable();
            $table->datetime('datereview_extension')->nullable();
            $table->datetime('dateapproved_extension')->nullable();
            $table->datetime('date_reminder')->nullable();
            $table->boolean('deletion_flag')->default(0);
            $table->boolean('duedate_status')->default(0);
            $table->datetime('old_duedate')->nullable();
            $table->longText('extension_notes')->nullable();
            $table->longText('cancel_duedate_notes')->nullable();
            $table->longText('cancel_extension_notes')->nullable();
            $table->longText('notes')->nullable();
            $table->integer('extension_count')->nullable(); 
            $table->string('actionstatus')->nullable();   
            $table->string('sign_type')->nullable();        
            $table->longText('longtext1')->nullable();
            $table->longText('longtext2')->nullable();
            $table->longText('longtext3')->nullable();            
            $table->string('text2')->nullable();            
            $table->datetime('date1')->nullable(); 
            $table->datetime('date2')->nullable();
            $table->datetime('date3')->nullable(); 
            $table->datetime('date4')->nullable();   
            $table->datetime('deleted_at')->nullable();            
            $table->timestamps();
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
        Schema::dropIfExists('lup_actions');
    }
};
