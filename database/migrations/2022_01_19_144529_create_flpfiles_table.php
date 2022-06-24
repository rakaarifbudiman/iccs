<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlpfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flpfiles', function (Blueprint $table) {
            $table->id();            
            $table->string('code')->nullable();
            $table->string('nofile')->nullable();
            $table->string('document_name')->nullable();            
            $table->string('org_file_name')->nullable();
            $table->string('file_path')->nullable();
            $table->string('uploader')->nullable();
            $table->datetime('date_upload')->nullable();
            $table->longText('notes')->nullable();                   
            $table->longText('longtext1')->nullable();
            $table->longText('longtext2')->nullable();
            $table->longText('longtext3')->nullable();
            $table->string('text1')->nullable();
            $table->string('text2')->nullable();
            $table->string('text3')->nullable();
            $table->datetime('date1')->nullable(); 
            $table->datetime('date2')->nullable();
            $table->datetime('date3')->nullable(); 
            $table->datetime('date4')->nullable();            
            $table->timestamps();
            $table->boolean('is_evidence')->nullable();
            $table->string('action')->nullable();
            $table->biginteger('actionid')->nullable();
            $table->index(['code']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flpfiles');
    }
}
