<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('TraduccionesProducto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 100);
            $table->string('subnombre', 100);
            $table->string('descripcion', 400);
            $table->integer('productoID')->unsigned();
            $table->integer('idiomaID')->unsigned();
            $table->string('slug', 150)->unique();
            
            $table->timestamps();

            $table->foreign('productoID')->references('id')->on('Producto')
            ->onDelete("NO ACTION")
            ->onUpdate("NO ACTION");

            $table->foreign('idiomaID')->references('id')->on('Idiomas')
            ->onDelete("NO ACTION")
            ->onUpdate("NO ACTION");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TraduccionesProducto');
    }
};
