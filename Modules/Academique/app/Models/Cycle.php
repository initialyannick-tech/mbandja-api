<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cycle extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['libelle', 'ordre', 'session_id'];

    public function session() { 
        return $this->belongsTo(Session::class); 
    }
    public function classes() { 
        return $this->hasMany(Classe::class); 
    }
}
