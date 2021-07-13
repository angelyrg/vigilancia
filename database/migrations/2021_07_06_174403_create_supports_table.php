<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supports', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('vigilante_id')->unsigned();

            $table->string('oficina', 100);
            $table->string('documento', 50);
            $table->string('destino', 100);

            $table->char('estado', 1);
            $table->datetime('fecha_retorno')->nullable();
            $table->integer('login_id');

            $table->timestamps();


            $table->foreign('vigilante_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supports');
    }
}
