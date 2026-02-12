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

    public function mettreAJourStatut()
    {
        $totalPaye = $this->paiements()->sum('montant');
        $montantTotal = $this->classe->frais_inscription ?? 0;

        if ($totalPaye <= 0) {
            $nouveauStatut = 'impaye';
        } elseif ($totalPaye < $montantTotal) {
            $nouveauStatut = 'partiel';
        } else {
            $nouveauStatut = 'solde';
        }

        if ($this->statut_paiement !== $nouveauStatut) {
            $this->update(['statut_paiement' => $nouveauStatut]);
        }
    }


    
}
