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
        Schema::create('zone', function (Blueprint $table) {
            $table->bigIncrements('idzone');
            $table->unsignedBigInteger('idcontainer');
            $table->foreign('idcontainer')->references('idcontainer')->on('container')->onDelete('cascade');
            $table->char('zonestockage');
            $table->date('datestockage');
            $table->time('heurestockage');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('zone');
    }
};
