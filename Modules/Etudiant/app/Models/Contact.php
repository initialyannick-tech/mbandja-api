<?php

namespace Modules\Etudiant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ["nom", "prenom", "telephone", "type", "etudiant_id"];



    public function etudiants()
    {
        return $this->belongsTo(Etudiant::class);
    }

   
}
