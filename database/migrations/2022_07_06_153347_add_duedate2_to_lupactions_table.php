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
        Schema::table('lup_actions', function (Blueprint $table) {
            $table->datetime('old_duedate2')->nullable();     
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lup_actions', function (Blueprint $table) {
            $table->dropColumn('old_duedate2');
        });
    }
};
