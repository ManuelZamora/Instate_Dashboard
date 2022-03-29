<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Cotizantes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::connection('mysql2')->create('users', function ($table) {
            $table->integer('id', 11);
            $table->string('nombre', 45);
            $table->string('correo',45);
            $table->string('lado', 45);
            $table->string('acho', 45);
            $table->string('ubicacion', 45);
            $table->string('tipo_proyecto', 45);
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
