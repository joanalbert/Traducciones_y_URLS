<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Idioma;
class IdiomaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                
                'idioma' => 'Espanol'
            ],
            [
                
                'idioma' => 'Catalan'
            ],
            [
                
                'idioma' => 'Ingles'
            ],
        );

        Idioma::insert($data);
    }
}
