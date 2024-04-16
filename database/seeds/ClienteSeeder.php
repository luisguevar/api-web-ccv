<?php

use App\Models\Cliente\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::create([
            "cNombres" => "José Antonio ",
            "cApellidos" => "Martinez Gutierrez",
            "cCorreo" => "josecliente@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "79866545",
            "cCelular" => "967895756",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790",
            "usuario_id" => 2
        ]);
    }
}
