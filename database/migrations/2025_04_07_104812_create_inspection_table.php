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
        Schema::create('inspection', function (Blueprint $table) {
            $table->bigIncrements('idinspection');
            $table->unsignedBigInteger('idcargaison');
            $table->foreign('idcargaison')->references('idcargaison')->on('cargaison')->onDelete('cascade');
            $table->unsignedBigInteger('idcontainer');
            $table->foreign('idcontainer')->references('idcontainer')->on('container')->onDelete('cascade');
            $table->char('etatinspection');
            $table->char('rapport');
            $table->date('dateinspection');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection');
    }
};
