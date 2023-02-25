<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = Array(
            [
                'precio' => 3.14,
                'stock' => 3,
                'referencia' => 'ABC'
            ],
            [
                'precio' => 6.67,
                'stock' => 7,
                'referencia' => 'DEF'
            ]
        );

        Producto::insert($data);
    }
}
