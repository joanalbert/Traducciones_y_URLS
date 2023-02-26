<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\TraduccionesProducto;

class Producto extends Model
{
    public static $TEST_QUERY = "SELECT * FROM Product;";

    use HasFactory;
    
    protected $table = "Producto";
    protected $fillable = [
        'precio',
        'stock',
        'referencia',
        'nombre_base'
    ];

    //definir una relacion de modelos llamada "traducciones" 
    public function traducciones()
    {
        //un Producto tiene muchas TraduccionesProducto 
        return $this->hasMany(TraduccionesProducto::class, 'productoID');
    }
}
