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
        Schema::connection('mysql2')->dropIfExists('master_parts');
        Schema::connection('mysql2')->create('master_parts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('rdms_part')->nullable();
            $table->string('code_project')->nullable();
            $table->string('old_part')->nullable();
            $table->string('old_desc')->nullable();
            $table->string('sap_part')->nullable();
            $table->string('sap_desc', 40)->nullable();
            $table->string('sap_mat_type')->nullable();
            $table->string('sap_mat_group')->nullable();
            $table->string('sap_uom')->nullable();
            $table->string('sap_edisi')->nullable();
            $table->string('note_change')->nullable();
            $table->string('requester_part')->nullable();
            $table->string('sap_status_part')->nullable();
            $table->string('rdms_status_part')->nullable();
            $table->string('rdms_remarks')->nullable();  
            $table->datetime('sap_date_input')->nullable();     
            $table->datetime('rdms_date_share')->nullable();       
            $table->string('dosage_form')->nullable();    
            $table->string('primary_packaging')->nullable();   
            $table->string('product_type')->nullable();    
            $table->string('product_group')->nullable(); 
            $table->string('product_content_box')->nullable(); 
            $table->string('product_bruto_box')->nullable(); 
            $table->string('product_dimension_box')->nullable();
            $table->string('product_content_mstbox')->nullable(); 
            $table->string('product_bruto_mstbox')->nullable(); 
            $table->string('product_dimension_mstbox')->nullable();
            $table->string('product_shelf_life')->nullable();
            $table->string('product_batch_size')->nullable();
            $table->string('product_storage')->nullable();
            $table->string('rdms_brand')->nullable();
            $table->string('rdms_manuf')->nullable();
            $table->string('rdms_supplier')->nullable();
            $table->string('rdms_storage')->nullable();            
            $table->string('shelf_life_type',1)->nullable(); 
            $table->decimal('rdms_saftey_stock', 10,3)->nullable();   
            $table->decimal('stock_in', 10,3)->nullable();    
            $table->decimal('stock_out', 10,3)->nullable();                
            $table->decimal('totalstock', 10,3)->nullable();       
            $table->datetime('deleted_at')->nullable();  
            $table->index(['rdms_part','sap_part','sap_desc'])   ;   
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('master_parts');
    }
};
