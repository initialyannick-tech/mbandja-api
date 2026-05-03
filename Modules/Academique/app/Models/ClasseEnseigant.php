<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClasseEnseigant extends Model
{
    use HasFactory;

    protected $table = 'classe_enseignants';

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'classe_id',
        'enseignant_id',
        'matiere_id'
    ];

    
}
