<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Classe extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['code', 'libelle','capacite','cycle_id','session_id', 'frais_inscription'];


    protected static function boot()
    {
        parent::boot();
        static::creating(function ($classe) {
            if (!$classe->cycle) {
                $classe->load('cycle');
            }
            
            if (!$classe->cycle) {
                throw new \Exception('Cycle introuvable pour la classe');
            }

            do {
                $cycle = Str::upper(Str::ascii($classe->cycle->libelle));
                $cycleCode = substr(preg_replace('/[^A-Z]/', '', $cycle), 0, 3);
                $cycleCode = str_pad($cycleCode, 3, 'X');
                $libelle = Str::upper(Str::ascii($classe->libelle));
                $libelleCode = substr(preg_replace('/[^A-Z]/', '', $libelle), 0, 3);
                $libelleCode = str_pad($libelleCode, 3, 'X');
                $year = now()->year;
                $code = "CL-{$cycleCode}-{$libelleCode}-{$year}";

            } while (self::where('code', $code)->exists());

            $classe->code = $code;
        });
    }

    protected static function booted()
    {
        static::created(function (Classe $classe) {
            $semestres = request()->input('semestres');
            if (is_array($semestres) && count($semestres) >= 2) {
                $classe->semestres()->sync($semestres);
            }
        });

        static::deleting(function (Classe $classe) {
            $classe->semestres()->detach();
        });
    }



    public function cycle() { 
        return $this->belongsTo(Cycle::class); 
    }
    public function session() { 
        return $this->belongsTo(Session::class); 
    }

    public function semestres()
    {
        return $this->belongsToMany(Semestre::class, 'classe_has_semestres');
    }

    public function unites() { 
        return $this->hasMany(Unite::class); 
    }
   


   
    
}
