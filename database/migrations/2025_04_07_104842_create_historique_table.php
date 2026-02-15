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
        Schema::create('historique', function (Blueprint $table) {
            $table->bigIncrements('idhistorique');
            $table->unsignedBigInteger('idcargaison');
            $table->foreign('idcargaison')->references('idcargaison')->on('cargaison')->onDelete('cascade');
            $table->unsignedBigInteger('idcontainer');
            $table->foreign('idcontainer')->references('idcontainer')->on('container')->onDelete('cascade');
            $table->unsignedBigInteger('idreception');
            $table->foreign('idreception')->references('idreception')->on('reception')->onDelete('cascade');
            $table->unsignedBigInteger('idexpeditions');
            $table->foreign('idexpeditions')->references('idexpeditions')->on('expeditions')->onDelete('cascade');
            $table->unsignedBigInteger('idmoyen');
            $table->foreign('idmoyen')->references('idmoyen')->on('moyen')->onDelete('cascade');
            $table->unsignedBigInteger('idgestionnaire');
            $table->foreign('idgestionnaire')->references('idgestionnaire')->on('gestionnaire')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historique');
    }
};
