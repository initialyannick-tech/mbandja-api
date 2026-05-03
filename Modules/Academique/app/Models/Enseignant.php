<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enseignant extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'telephone',
        'specialite'
    ];

   /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    // Enseignant → Classes
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_enseignants')->withTimestamps();
    }
}
