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
        return $this->belongsTo(Classe::class);
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
        if ($this->total_paye <= 0) {
            $this->statut_paiement = 'impaye';
        } elseif ($this->total_paye < $this->montant_total) {
            $this->statut_paiement = 'partiel';
        } else {
            $this->statut_paiement = 'solde';
        }

        $this->save();
    }

    
}
