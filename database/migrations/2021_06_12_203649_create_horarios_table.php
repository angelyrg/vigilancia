<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHorariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('horarios', function (Blueprint $table) {
            $table->increments('id');

            $table -> integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            
            $table -> integer('dia_semana_inicio');
            $table -> time('hora_inicio');

            $table -> integer('dia_semana_fin');
            $table -> time('hora_final');    

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
