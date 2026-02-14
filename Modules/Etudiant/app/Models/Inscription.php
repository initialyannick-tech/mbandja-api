<?php

namespace Modules\Etudiant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academique\Models\Classe;
use Modules\Academique\Models\Session;

class Inscription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'classe_id',
        'etudiant_id',
        'session_id',
        'date_inscription',
        'statut_paiement'
    ];

    protected $casts = [
        'date_inscription' => 'date'
    ];

    protected $appends = [
        'total_paye',
        'montant_total',
        'reste_a_payer'
    ];

    /* ================= RELATIONS ================= */

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }

    public function paiements()
    {
        return $this->hasMany(Paiement::class);
    }

    /* ================= LOGIQUE FINANCIÈRE ================= */

    public function getTotalPayeAttribute()
    {
        return $this->paiements()->sum('montant');
    }

    public function getMontantTotalAttribute()
    {
        return $this->classe->frais_inscription;
    }

    public function getSoldeAttribute()
    {
        return $this->montant_total - $this->total_paye;
    }

    public function getResteAPayerAttribute(): float
    {
        return max(0, $this->montant_total - $this->total_paye);
    }

    /* ================= LOGIQUE STATUT ================= */

    public function mettreAJourStatut(): void
    {
        $this->loadMissing('classe');

        $totalPaye = $this->total_paye;
        $montantTotal = $this->montant_total;

        if ($totalPaye <= 0) {
            $nouveauStatut = 'impaye';
        } elseif ($totalPaye < $montantTotal) {
            $nouveauStatut = 'partiel';
        } else {
            $nouveauStatut = 'solde';
        }

        if ($this->statut_paiement !== $nouveauStatut) {
            $this->statut_paiement = $nouveauStatut;
            $this->save();
        }
    }


    
}
