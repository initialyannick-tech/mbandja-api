<?php

namespace Modules\Academique\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Matiere extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = ['unite_id', 'code', 'libelle', 'coefficient'];

    


     protected static function boot()
     {
        parent::boot();
        static::creating(function ($matiere) {
            do {
                $libelle = Str::upper(Str::ascii($matiere->libelle));
                $initiales = substr(preg_replace('/[^A-Z]/', '', $libelle), 0, 3);
                $initiales = str_pad($initiales, 3, 'X');
                $year = now()->year;
                $code = "MAT-{$initiales}-{$year}";
            } while (self::where('code', $code)->exists());

            $matiere->code = $code;
        });
     }


    public function unite() { 
        return $this->belongsTo(Unite::class); 
    }
    // public function notes() { return $this->hasMany(Note::class); }
    // public function vacations() { return $this->hasMany(Vacation::class); }
    
}
