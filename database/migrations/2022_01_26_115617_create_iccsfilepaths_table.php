<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIccsfilepathsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iccsfilepaths', function (Blueprint $table) {
            $table->id();
            $table->integer('seq')->nullable();            
            $table->string('filepath')->nullable();
            $table->string('description')->nullable();
            $table->longtext('notes')->nullable();
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
        Schema::dropIfExists('iccsfilepaths');
    }
}
