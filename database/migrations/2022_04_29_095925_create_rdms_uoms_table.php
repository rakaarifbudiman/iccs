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
        Schema::connection('mysql2')->dropIfExists('rdms_uoms');
        Schema::connection('mysql2')->create('rdms_uoms', function (Blueprint $table) {
            $table->id();
            $table->string('uom',5)->unique();
            $table->string('uom_alias')->nullable();
            $table->longtext('desc_uom')->nullable();
            $table->timestamps();
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
        Schema::connection('mysql2')->dropIfExists('rdms_uoms');
    }
};
