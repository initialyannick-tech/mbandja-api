<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Session extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'libelle', 
        'date_debut', 
        'date_fin', 
        'active'
    ];

     protected $casts = [
        'date_debut' => 'date',
        'date_fin'   => 'date',
        'active'     => 'boolean',
    ];

    public function cycles() { 
        return $this->hasMany(Cycle::class); 
    }
    public function classes() { 
        return $this->hasMany(Classe::class); 
    }
    public function unites() { 
        return $this->hasMany(Unite::class); 
    }
}
