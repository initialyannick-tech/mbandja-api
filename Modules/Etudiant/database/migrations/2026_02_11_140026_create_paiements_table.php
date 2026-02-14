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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->string('numero_recu')->unique();
            $table->foreignId('inscription_id') ->constrained('inscriptions') ->cascadeOnDelete();
            $table->decimal('montant', 12, 2)->default(0);
            $table->date('date_paiement');
            $table->string('mode_paiement')->nullable();
            $table->text('reference')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
