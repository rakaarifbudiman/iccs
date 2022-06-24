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
        Schema::connection('mysql2')->dropIfExists('rdms_batches');
        Schema::connection('mysql2')->create('rdms_batches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('partbatch')->unique();
            $table->string('part');
            $table->string('batch')->nullable();
            $table->datetime('expired')->nullable();
            $table->boolean('deleted')->default(0)->nullable();   
            $table->string('created_by')->nullable();
            $table->longtext('notes')->nullable();
            $table->string('storage')->nullable();
            $table->decimal('stock_in')->nullable();
            $table->decimal('stock_out')->nullable();
            $table->decimal('stock')->nullable();
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
        Schema::connection('mysql2')->dropIfExists('rdms_batches');
    }
};
