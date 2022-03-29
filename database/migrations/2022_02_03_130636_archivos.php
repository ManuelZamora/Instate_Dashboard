<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Archivos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archivos', function(Blueprint $table){
            $table->integerIncrements('id', 11)->unique();
            $table->string('ciudad', 45);
            $table->string('estado', 45);
            $table->string('archivo', 100);
            $table->date('creacion');
            $table->foreignId('tipo')
            ->references('id')
            ->on('tipo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
