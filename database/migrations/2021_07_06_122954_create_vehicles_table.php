<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('id');

            $table->string('placa', 7);
            $table->string('conductor', 150);
            $table->string('dni_conductor', 8);
            $table->string('tipo_vehiculo', 50);
            $table->string('color', 25);
            $table->string('motivo');
            $table->char('estado', 1);
            
            $table->char('propiedad_epis', 1);

            $table->datetime('leave_at')->nullable();

            $table->integer('login_id');

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
        Schema::dropIfExists('vehicles');
    }
}
