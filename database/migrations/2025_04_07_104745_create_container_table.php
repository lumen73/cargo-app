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
        Schema::create('container', function (Blueprint $table) {
            $table->bigIncrements('idcontainer');
            $table->char('numerocontainer');
            $table->char('taillecontainer');
            $table->char('typecargaison');
            $table->char('paysorigine');
            $table->char('destination');
            $table->char('poidscontainer');
            $table->char('datearrivee');
            $table->char('etatinspection');
            $table->unsignedBigInteger('idcargaison');
            $table->foreign('idcargaison')->references('idcargaison')->on('cargaison')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('container');
    }
};
