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
        Schema::table('container', function (Blueprint $table) {

            // D'abord, on supprime la contrainte de clé étrangère
            $table->dropForeign(['idzone']);

            // Ensuite, on supprime la colonne
            $table->dropColumn('idzone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('container', function (Blueprint $table) {
            // 👇 En rollback, on recrée la colonne
            $table->unsignedBigInteger('idzone')->nullable();

            // 👇 Et on rétablit la contrainte si besoin
            $table->foreign('idzone')->references('id')->on('zones')->onDelete('cascade');
        });
    }
};
