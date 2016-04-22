<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEquipamentoLaboratoriosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipamentos_laboratorios', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',255);
            $table->text('description');
            $table->string('image',255);
            $table->integer('laboratorio_id');
            $table->foreign('laboratorio_id')->references('id')->on('laboratorios');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('equipamentos_laboratorios');
    }
}
