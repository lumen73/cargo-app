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
        Schema::table('cargaison', function (Blueprint $table) {
            $table->string('naturemarchandise');
            $table->float('volumemarchandise');
            $table->float('poidscargaison');
            $table->float('valeurcargaison');
            $table->enum('etatcargaison', ['dechargement', 'transit', 'charge']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cargaison', function (Blueprint $table) {
            //
        });
    }
};
