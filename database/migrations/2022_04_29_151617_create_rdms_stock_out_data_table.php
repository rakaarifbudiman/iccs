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
        Schema::connection('mysql2')->dropIfExists('stock_out_data');
        Schema::connection('mysql2')->create('stock_out_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('transaction_id')->nullable();
            $table->string('formula_no')->nullable();
            $table->string('part')->nullable();
            $table->string('batch')->nullable();            
            $table->string('uom_out')->nullable();                   
            $table->longtext('notes')->nullable();
            $table->string('qty_unit')->nullable();          
            $table->decimal('qty_out',12,3)->nullable();
            $table->decimal('qty_konversi',12,3)->nullable();
            $table->datetime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('mysql2')->dropIfExists('stock_out_data');
    }
};
