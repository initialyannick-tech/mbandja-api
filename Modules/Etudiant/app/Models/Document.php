<?php

namespace Modules\Etudiant\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;

    protected $table="document_legals";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'etudiant_id',
        'libelle',
        'lien'
    ];
    

    public function etudiants(){
        return $this->belongsTo(Etudiant::class);
    }

   
}
