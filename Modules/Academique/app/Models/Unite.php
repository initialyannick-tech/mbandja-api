<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Unite extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['code', 'libelle','classe_id','semestre_id','session_id', 'credit'];

    protected $casts = [
        'credit' => 'decimal:2',
    ];


    
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($unite) {
            do {
                $libelle = Str::upper(Str::ascii($unite->libelle));
                $initiales = substr(preg_replace('/[^A-Z]/', '', $libelle), 0, 3);
                $initiales = str_pad($initiales, 3, 'X');
                $year = now()->year;
                $code = "UE-{$initiales}-{$year}";
            } while (self::where('code', $code)->exists());

            $unite->code = $code;
        });
    }

    public function classe() { 
        return $this->belongsTo(Classe::class); 
    }
    public function semestre() { 
        return $this->belongsTo(Semestre::class); 
    }
    public function session() { 
        return $this->belongsTo(Session::class); 
    }

    public function matieres() { 
        return $this->hasMany(Matiere::class); 
    }
}
