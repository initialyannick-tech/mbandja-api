<?php

namespace Modules\Note\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Academique\Models\Matiere;
use Modules\Etudiant\Models\Inscription;

// use Modules\Note\Database\Factories\NoteFactory;

class Note extends Model
{
    use HasFactory;

    protected $table="notes";

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'inscription_id',
        'matiere_id',
        'type', 
        'libelle',
        'valeur',
        'appreciation',
    ];

    public function inscription()
    {
        return $this->belongsTo(Inscription::class);
    }

    public function matiere()
    {
        return $this->belongsTo(Matiere::class);
    }
}
