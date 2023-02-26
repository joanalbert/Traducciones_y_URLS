<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



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

    
}
