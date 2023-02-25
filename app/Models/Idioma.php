<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//es = 0
//ca = 1
//en = 2

class Idioma extends Model
{
    use HasFactory;
    protected $table = "Idiomas";
    protected $fillable = [
        'idioma'
    ];
}
