<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reception', function (Blueprint $table) {
            $table->bigIncrements('idreception');
            $table->unsignedBigInteger('idgestionnaire');
            $table->foreign('idgestionnaire')->references('idgestionnaire')->on('gestionnaire')->onDelete('cascade');
            $table->unsignedBigInteger('idcargaison');
            $table->foreign('idcargaison')->references('idcargaison')->on('cargaison')->onDelete('cascade');
            $table->date('datearrivee');
            $table->integer('nombrecontainer');
            $table->char('lieudereception');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reception');
    }
};
