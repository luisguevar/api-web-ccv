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

        DB::table('categorias')->insert([
            'cDescripcion' => 'Memoria Ram',
            'cImagen' => 'categorias/XYI91z1WOyNLAlN8OVu69M2W0AR0Utz4P4tC8z5m.jpg',
            'cIcono' => 'las la-memory',
            'nEstado' => 1,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categorias')->insert([
            'cDescripcion' => 'Mouse',
            'cImagen' => 'categorias/BKN61MhUUG3BKFAbkCcZHz9kv8zzRyKO9vCcAM08.jpg',
            'cIcono' => 'las la-mouse',
            'nEstado' => true,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categorias')->insert([
            'cDescripcion' => 'Laptop',
            'cImagen' => 'categorias/avpkj7QN6BtOGG2rJNlKTYW2vY6SEIflkvKRDNQU.png',
            'cIcono' => 'las la-laptop',
            'nEstado' => true,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('categorias')->insert([
            'cDescripcion' => 'Teclado',
            'cImagen' => 'categorias/JvWmrvdUKnINq5PUNVBvq2Szvsvw53rWkYlwioLp.webp',
            'cIcono' => 'las la-keyboard',
            'nEstado' => true,
            'cUsuarioCreacion' => '74757790',
            'cUsuarioModificacion' => '74757790',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
