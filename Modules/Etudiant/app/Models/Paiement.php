<?php

namespace Modules\Etudiant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Paiement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'numero_recu',
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

    public function etudiant()
    {
        return $this->hasOneThrough(
            Etudiant::class,       // Le modèle final que tu veux récupérer
            Inscription::class,    // Le modèle intermédiaire
            'id',                  // clé primaire de l’inscription (foreignKey sur Paiement)
            'id',                  // clé primaire de l’étudiant
            'inscription_id',      // clé étrangère de Paiement vers Inscription
            'etudiant_id'          // clé étrangère de Inscription vers Etudiant
        );
    }


    /* ================= AUTO UPDATE STATUT ================= */

    protected static function booted()
    {
        static::creating(function ($paiement) {

            $inscription = Inscription::findOrFail($paiement->inscription_id);

            $totalActuel = $inscription->paiements()->sum('montant');
            $nouveauTotal = $totalActuel + $paiement->montant;

            if ($nouveauTotal > $inscription->classe->frais_inscription) {
                throw new \Exception("Le paiement dépasse le montant dû.");
            }

            // Génération numéro reçu
            $paiement->numero_recu ='REC-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6));
        });
        static::created(function ($paiement) {
            if ($paiement->inscription) {
                $paiement->inscription->mettreAJourStatut();
            }
        });

        static::deleted(function ($paiement) {
            if ($paiement->inscription) {
                $paiement->inscription->mettreAJourStatut();
            }
        });
    }

    
}
