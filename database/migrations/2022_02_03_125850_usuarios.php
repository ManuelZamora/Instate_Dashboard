<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Usuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('usuarios', function (Blueprint $table) {
            $table->integerIncrements('id')->unique();
            $table->string('correo', 45);
            $table->string('contraseña', 45);
            $table->foreign('id_personas')
            ->references('id')
            ->on('personas');
            $table->foreign('id_permisos')
            ->references('id')
            ->on('permisos');

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
