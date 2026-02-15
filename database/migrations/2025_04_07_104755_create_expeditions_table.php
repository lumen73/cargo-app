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
        Schema::create('expeditions', function (Blueprint $table) {
            $table->bigIncrements('idexpeditions');
            $table->unsignedBigInteger('idmoyen');
            $table->foreign('idmoyen')->references('idmoyen')->on('moyen')->onDelete('cascade');
            $table->unsignedBigInteger('idgestionnaire');
            $table->foreign('idgestionnaire')->references('idgestionnaire')->on('gestionnaire')->onDelete('cascade');
            $table->unsignedBigInteger('idcontainer');
            $table->foreign('idcontainer')->references('idcontainer')->on('container')->onDelete('cascade');
            $table->date('datedepart');
            $table->char('destination');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expeditions');
    }
};
