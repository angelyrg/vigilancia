<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->increments('id');

            $table->string('dni', 8);
            $table->string('nombres', 100);
            $table->string('apellidos', 100);
            $table->string('motivo');
            $table->char('estado', 1);
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
        Schema::dropIfExists('visitors');
    }
}
