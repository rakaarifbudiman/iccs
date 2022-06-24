<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFlpevidencefilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flpevidencefiles', function (Blueprint $table) {
            $table->id();            
            $table->string('code')->nullable();
            $table->string('nofile')->unique();
            $table->string('noaction')->nullable(); 
            $table->string('document_name')->nullable();            
            $table->string('file_name')->nullable();
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
        Schema::dropIfExists('flpevidencefiles');
    }
}
