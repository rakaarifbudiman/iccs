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
        Schema::create('lup_parents', function (Blueprint $table) {
            $table->id();
            $table->integer('year')->nullable();
            $table->datetime('date_input')->nullable(); 
            $table->string('code')->unique();
            $table->string('nolup')->nullable();
            $table->longText('documentname')->nullable();
            $table->string('lupstatus')->nullable();
            $table->longtext('lup_type')->nullable(); 
            $table->string('lup_type_others')->nullable(); 
            $table->string('lup_subtype')->nullable(); 
            $table->string('duedate_type')->nullable(); 
            $table->datetime('duedate_start')->nullable();
            $table->datetime('duedate_start_temporary')->nullable();
            $table->datetime('duedate_finish')->nullable();            
            $table->longText('lup_current')->nullable();
            $table->longText('lup_proposed')->nullable();
            $table->longText('lup_reason')->nullable();
            $table->boolean('product_attachment')->nullable()->default(0);
            $table->boolean('utility_attachment')->nullable()->default(0);
            $table->boolean('document_attachment')->nullable()->default(0);
            $table->boolean('support_attachment')->nullable()->default(0);
            $table->boolean('product_impact')->nullable()->default(0);
            $table->boolean('facilities_impact')->nullable()->default(0);
            $table->boolean('equipment_impact')->nullable()->default(0);
            $table->boolean('productcontact_impact')->nullable()->default(0);
            $table->boolean('decomission_impact')->nullable()->default(0);
            $table->boolean('maintenance_impact')->nullable()->default(0);
            $table->boolean('compliance_impact')->nullable()->default(0);
            $table->boolean('regulatory_impact')->nullable()->default(0);
            $table->boolean('patient_impact')->nullable()->default(0);
            $table->boolean('integrity_impact')->nullable()->default(0);
            $table->boolean('environment_impact')->nullable()->default(0);
            $table->boolean('health_impact')->nullable()->default(0);
            $table->boolean('computer_impact')->nullable()->default(0);
            $table->boolean('supply_impact')->nullable()->default(0);
            $table->boolean('validation_impact')->nullable()->default(0);
            $table->boolean('stability_impact')->nullable()->default(0);
            $table->boolean('permanent')->nullable()->default(0);
            $table->boolean('temporary')->nullable()->default(0);
            $table->string('categorization')->nullable();
            $table->boolean('external_party')->nullable()->default(0);
            $table->longText('risk_assestment')->nullable();
            $table->string('inisiator')->nullable();
            $table->string('leader')->nullable();
            $table->string('external_party_name')->nullable();
            $table->string('regulatory_reviewer')->nullable();
            $table->string('regulatory_approver')->nullable();
            $table->string('reviewer')->nullable();
            $table->string('reviewer2')->nullable();
            $table->string('approver')->nullable();
            $table->string('confirmer')->nullable();
            $table->longText('note_leader')->nullable();
            $table->longText('note_external_party')->nullable();
            $table->longText('note_regulatory')->nullable();
            $table->longText('note_regulatory_reviewer')->nullable();
            $table->longText('note_regulatory_approver')->nullable();
            $table->longText('note_reviewer')->nullable();
            $table->longText('note_reviewer2')->nullable();
            $table->longText('note_approver')->nullable();
            $table->longText('note_confirmer')->nullable();
            $table->longText('notes')->nullable();            
            $table->string('regulatory_change_type')->nullable();
            $table->string('regulatory_variation')->nullable();
            $table->datetime('datesign_inisiator')->nullable();
            $table->datetime('datesign_leader')->nullable();
            $table->datetime('datesign_regulatory_approver')->nullable();
            $table->datetime('datesubmit_regulatory_reviewer')->nullable();
            $table->datetime('datesubmit_regulatory_approver')->nullable();
            $table->datetime('datesubmit_reviewer')->nullable();
            $table->datetime('datesubmit_reviewer2')->nullable();
            $table->datetime('datesubmit_approver')->nullable();
            $table->datetime('dateapproved')->nullable();
            $table->datetime('dateconfirmed')->nullable();
            $table->boolean('approved')->nullable()->default(0);
            $table->boolean('confirmed')->nullable()->default(0);
            $table->boolean('action_requirement')->nullable()->default(0);
            $table->longText('action_notes')->nullable();
            $table->longText('action_notifier')->nullable();
            $table->longText('closing_notes')->nullable();
            $table->string('verified_a')->nullable();
            $table->string('verified_b')->nullable();
            $table->string('verified_c')->nullable();
            $table->string('reviewer_closing')->nullable();
            $table->string('approver_closing')->nullable();
            $table->longText('approverclosing_notes')->nullable();
            $table->datetime('dateclosing_reviewer')->nullable(); 
            $table->datetime('dateclosing_approver')->nullable();
            $table->integer('extension_count')->nullable();    
            $table->integer('revision')->nullable()->default(0);        
            $table->longText('cancel_notes')->nullable();            
            $table->string('cancel_requester')->nullable();
            $table->string('datecancel_request')->nullable();   
            $table->string('cancel_reviewer')->nullable();
            $table->string('datecancel_reviewed')->nullable(); 
            $table->string('cancel_approver')->nullable();
            $table->string('datecancel_approved')->nullable(); 
            $table->longText('approvercancel_notes')->nullable();             
            $table->boolean('extension')->nullable()->default(0);  
            $table->boolean('adjustments')->nullable()->default(0);  
            $table->datetime('deleted_at')->nullable();           
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
        Schema::dropIfExists('lup_parents');
    }
};
