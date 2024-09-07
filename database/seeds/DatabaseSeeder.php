<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
        
            UsuarioSeeder:: class,
            ClienteSeeder::class,
            CategoriaSeeder::class,
            ProveedorSeeder::class,
            ProveedorContactoSeeder::class,
            ProductoSeeder::class,
            ProductoImagenesSeeder::class,
            CotizacionSeeder::class,
            VentasSeeder::class
        ]);
    }
}
