<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TraduccionesProducto;

class TraduccionesProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Array(
            //PRODUCTO 1
            [
                'nombre' => 'Sombrilla',
                'subnombre' => 'Sombrilla grande metalica',
                'descripcion' => 'Sombrilla ideal para piscinas y bares',
                'productoID' => 1,
                'idiomaID' => 1,
                'slug' => 'sombrilla',
            ],
            [
                'nombre' => 'Parasol',
                'subnombre' => 'Sombrilla grosa metalica',
                'descripcion' => 'Sombrilla ideal per a picines i bars',
                'productoID' => 1,
                'idiomaID' => 2,
                'slug' => 'parasol',
            ],
            [
                'nombre' => 'Umbrella',
                'subnombre' => 'Big metallic umbrella',
                'descripcion' => 'Most ideal for swimming pools and bars',
                'productoID' => 1,
                'idiomaID' => 3,
                'slug' => 'umbrella',
            ],
            //PRODUCTO 2
            [
                'nombre' => 'Banco de exteriores',
                'subnombre' => 'Banco de madera para exteriores',
                'descripcion' => 'Reistente a los elementos perfecto para jardines y plazas',
                'productoID' => 2,
                'idiomaID' => 1,
                'slug' => 'banco-de-exteriores',
            ],
            [
                'nombre' => 'Banc exterior',
                'subnombre' => 'Banc de fusta per a exteriors',
                'descripcion' => 'Resistent als elements perfecte per a jardins i plaçes',
                'productoID' => 2,
                'idiomaID' => 2,
                'slug' => 'banc-exterior',
            ],
            [
                'nombre' => 'Exterior bench',
                'subnombre' => 'Outdoor wooden bench',
                'descripcion' => 'Weather resistant, ideal for gardens and other public places',
                'productoID' => 2,
                'idiomaID' => 3,
                'slug' => 'exterior-bench',
            ],
        );

        TraduccionesProducto::insert($data);
    }
}
