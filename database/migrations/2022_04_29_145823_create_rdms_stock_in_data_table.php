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
        Schema::connection('mysql2')->dropIfExists('stock_in_data');
        Schema::connection('mysql2')->create('stock_in_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('transaction_id')->nullable();
            $table->string('po_number')->nullable();
            $table->string('part')->nullable();
            $table->string('batch')->nullable();
            $table->datetime('expired')->nullable();
            $table->string('uom_input')->nullable();
            $table->string('storage')->nullable();           
            $table->longtext('notes')->nullable();
            $table->decimal('qty_input',12,3)->nullable();
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
        Schema::connection('mysql2')->dropIfExists('stock_in_data');
    }
};
