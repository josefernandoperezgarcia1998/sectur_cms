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
        Schema::create('paginas_secciones_subseccion_archivos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->longText('archivo')->nullable();
            $table->string('tipo')->nullable();
            $table->string('size_archivo')->nullable();
            $table->string('enlace')->nullable();
            $table->enum('estado', ['Si','No'])->default('Si');
            $table->unsignedBigInteger('subseccion_id')->nullable();
            $table->foreign('subseccion_id')->references('id')->on('paginas_secciones_subseccion')->onDelete('cascade');
            $table->string('subseccion_slug');
            $table->string('seccion_slug');
            $table->string('pagina_slug');
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
        Schema::dropIfExists('paginas_secciones_subseccion_archivos');
    }
};