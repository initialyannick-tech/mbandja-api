<?php

namespace Modules\Note\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Note\Database\Factories\NoteFactory;

class Note extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    // protected static function newFactory(): NoteFactory
    // {
    //     // return NoteFactory::new();
    // }
}
