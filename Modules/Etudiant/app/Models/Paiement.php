<?php

namespace Modules\Etudiant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paiement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'numero',
        'inscription_id',
        'montant',
        'date_paiement',
        'mode_paiement',
        'reference'
    ];

    protected $casts = [
        'montant' => 'decimal:2',
        'date_paiement' => 'date'
    ];

    /* ================= RELATION ================= */

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }

    /* ================= AUTO UPDATE STATUT ================= */

    protected static function booted()
    {
        static::created(function ($paiement) {
            $paiement->inscription->mettreAJourStatut();
        });

        static::deleted(function ($paiement) {
            $paiement->inscription->mettreAJourStatut();
        });
    }
    
}
