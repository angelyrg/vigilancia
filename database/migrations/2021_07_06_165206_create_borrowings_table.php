<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nombre_bien', 75);
            $table->integer('cantidad');
            $table->string('nombre_encargado', 150);
            $table->text('descripcion');
            $table->char('estado', 1);
            $table->datetime('fecha_devolucion')->nullable();
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
        Schema::dropIfExists('borrowings');
    }
}
