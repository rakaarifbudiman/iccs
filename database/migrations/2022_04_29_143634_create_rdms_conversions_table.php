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
        Schema::connection('mysql2')->dropIfExists('rdms_conversions');
        Schema::connection('mysql2')->create('rdms_conversions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();           
            $table->string('part')->nullable();
            $table->string('uom_from')->nullable();
            $table->string('uom_to')->nullable();           
            $table->decimal('value',12)->nullable();
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
        Schema::connection('mysql2')->dropIfExists('rdms_conversions');
    }
};
