<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categorias = [
            [
                'cDescripcion' => 'Memoria Ram',
                'cImagen' => 'categorias/XYI91z1WOyNLAlN8OVu69M2W0AR0Utz4P4tC8z5m.jpg',
                'cIcono' => 'las la-memory',
                'nEstado' => 1,
            ],
            [
                'cDescripcion' => 'Mouse',
                'cImagen' => 'categorias/BKN61MhUUG3BKFAbkCcZHz9kv8zzRyKO9vCcAM08.jpg',
                'cIcono' => 'las la-mouse',
                'nEstado' => true,
            ],
            [
                'cDescripcion' => 'Laptop',
                'cImagen' => 'categorias/avpkj7QN6BtOGG2rJNlKTYW2vY6SEIflkvKRDNQU.png',
                'cIcono' => 'las la-laptop',
                'nEstado' => true,
            ],
            [
                'cDescripcion' => 'Teclado',
                'cImagen' => 'categorias/JvWmrvdUKnINq5PUNVBvq2Szvsvw53rWkYlwioLp.webp',
                'cIcono' => 'las la-keyboard',
                'nEstado' => true,
            ],
        ];

        foreach ($categorias as $categoria) {
            $categoria['cUsuarioCreacion'] = '74757790';
            $categoria['cUsuarioModificacion'] = '74757790';
            $categoria['created_at'] = now();
            $categoria['updated_at'] = now();

            DB::table('categorias')->insert($categoria);
        }
    }
}
