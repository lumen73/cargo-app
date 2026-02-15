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
        Schema::table('zone', function (Blueprint $table) {
            $table->unsignedBigInteger('idcontainer');
            $table->foreign('idcontainer')->references('idcontainer')->on('container')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('zone', function (Blueprint $table) {
            $table->dropColumn('idcontainer');
        });
    }
};
