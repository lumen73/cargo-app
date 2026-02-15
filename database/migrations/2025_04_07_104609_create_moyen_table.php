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
        Schema::create('moyen', function (Blueprint $table) {
            $table->bigIncrements('idmoyen');
            $table->string('transport');
            $table->string('nomchauffeur');
            $table->string('prenomschauffeur');
            $table->integer('numero');
            $table->char('permis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moyen');
    }
};
