<?php

namespace Modules\Etudiant\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Etudiant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'matricule',
        'prenom',
        'nom',
        'date_naissance',
        'lieu_naissance',
        'telephone',
        'email',
        'adresse',
        'sexe',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($etudiant) {
            do {
                $currentYear = Carbon::now()->year;
                $nom_simplifie = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', substr($etudiant->nom, 0, 3)));
                // Extraire le jour, mois et année de la date de naissance
                $date_naissance = Carbon::parse($etudiant->date_naissance);
                $date_code = strtoupper($date_naissance->format('dmy')); // Format: jour mois année (ex: 150123 pour 15/01/2023)
                $random_number = mt_rand(1000, 9999);  // Numéro aléatoire à 4 chiffres
                $matricule_etudiant = strtoupper("{$currentYear}-{$nom_simplifie}-{$date_code}-{$random_number}");
            } while (Etudiant::where('matricule', $matricule_etudiant)->exists()); // Vérifier l'unicité
            $etudiant->matricule = $matricule_etudiant;
        });
    }


    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function documents()
    {
        return $this->hasMany(Document::class);
    }

     public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'etudiant_id');
    }

}
