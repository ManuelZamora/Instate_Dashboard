<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DatosCasaInteres extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos_casa_interes', function(Blueprint $table){
            $table->integerIncrements('id', 11)->unique();
            $table->text('titulo');
            $table->float('precio',8,2);
            $table->integer('nRecamaras', 11);
            $table->float('m2_construidos',8,2);
            $table->text('ubicacion');
            $table->text('link');
            $table->text('imagen');
            $table->float('lat',8,2);
            $table->float('lng',8,2);
            $table->foreign('archivo')->references('id')->on('archivos');
            $table->float('pm2',8,2);
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
