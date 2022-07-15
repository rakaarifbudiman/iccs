<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->smallInteger('level');
            $table->string('leader')->nullable();
            $table->string('department')->nullable();
            $table->string('grade')->nullable();
            $table->smallInteger('grade_level')->nullable();
            $table->string('email');
            $table->boolean('active')->default(0);
            $table->longText('notes')->nullable();
            $table->datetime('password_change_at')->nullable();
            $table->string('password');
            $table->string('unid');
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->datetime('deleted_at')->nullable();
            $table->datetime('last_seen')->nullable();
            $table->string('ip_login')->nullable();
            $table->string('token')->nullable();            
            $table->smallInteger('level_rdms')->nullable();
            $table->smallInteger('level_rnie')->nullable();
            $table->smallInteger('level_woms')->nullable();
            $table->smallInteger('level_capa')->nullable();
            $table->index(['level','active','last_seen']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
