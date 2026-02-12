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
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('classe_id')->constrained('classes');
            $table->foreignId('etudiant_id')->constrained('etudiants');
            $table->foreignId('session_id')->constrained('sessions');
            $table->date('date_inscription');
            $table->enum('statut_paiement', ['impaye','partiel','solde'])->default('impaye');
            $table->unique(['etudiant_id', 'session_id', 'classe_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
