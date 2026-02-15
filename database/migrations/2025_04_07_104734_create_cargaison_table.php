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

        Schema::disableForeignKeyConstraints();


        Schema::create('cargaison', function (Blueprint $table) {
            $table->bigIncrements('idcargaison');
            $table->char('nomcargaison');
            $table->unsignedBigInteger('idgestionnaire');
            $table->foreign('idgestionnaire')->references('idgestionnaire')->on('gestionnaire')->onDelete('cascade');
            $table->char('naturemarchandise');
            $table->char('volumemarchandise');
            $table->char('poidscargaison');
            $table->char('valeurcargaison');
            $table->char('etatcargaison');
            $table->char('etatinspection');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargaison');
    }
};
