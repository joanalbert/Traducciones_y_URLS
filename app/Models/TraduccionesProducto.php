<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 1.- importar Sluggable
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class TraduccionesProducto extends Model
{
    use HasFactory;
    use hasSlug; // <- 2.- hacer uso de hasSlug, esto es llamado un 'trait' es parecido a implementar una interface llamada hasSlug

    protected $table = "TraduccionesProducto";
    protected $fillable = [
        'nombre',
        'subnombre',
        'descripcion',
        'productoID',
        'idiomaID',
        'slug' // <- 3.- actualizar fillable con el nuevo campo 'slug'
    ];

    //4.- definir una configuracion para sluggable
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nombre') //especificar el campo a partir del qual se van a generar los slugs
            ->saveSlugsTo('slug'); //especificar en que campo se van a guardar los slugs
    }
}
