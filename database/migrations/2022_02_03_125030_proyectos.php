<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Proyectos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proyectos', function (Blueprint $table) {
            $table->integerIncrements('id',11)->unique();
            $table->string('m2', 45);
            $table->string('direccion', 45);
            $table->string('lat', 45);
            $table->string('lng', 45);
            $table->foreignId('id_proyecto')->references('id')->on('tipos_pdf')->onDelete('cascade');
            $table->foreignId('id_cotizante')->references('id')->on('cotizantes')->onDelete('cascade');
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
