<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Semestre extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['libelle', 'ordre'];

    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'classe_has_semestres');
    }
}
