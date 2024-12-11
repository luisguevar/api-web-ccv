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
            "cNombres" => "María Fernanda",
            "cApellidos" => "Rodríguez Pérez",
            "cCorreo" => "mariafernanda@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "74589632",
            "cCelular" => "965874523",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790"
        ]);

        Cliente::create([
            "cNombres" => "Carlos Eduardo",
            "cApellidos" => "López Fernández",
            "cCorreo" => "carloslopez@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "75236985",
            "cCelular" => "978456321",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790"
        ]);

        Cliente::create([
            "cNombres" => "Ana Sofía",
            "cApellidos" => "García Ruiz",
            "cCorreo" => "anasofia@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "76982314",
            "cCelular" => "987654321",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790"
        ]);

        Cliente::create([
            "cNombres" => "Luis Alberto",
            "cApellidos" => "Vega Castillo",
            "cCorreo" => "luisvega@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "78451236",
            "cCelular" => "912345678",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790"
        ]);

        Cliente::create([
            "cNombres" => "Luis Antonio",
            "cApellidos" => "Guevara Aredo",
            "cCorreo" => "luisgAreado@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "74757790",
            "cCelular" => "9678965345",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790",
            "usuario_id" => 1
        ]);

        Cliente::create([
            "cNombres" => "Daniela Isabel",
            "cApellidos" => "Mendoza Torres",
            "cCorreo" => "danielamendoza@correo.com",
            "nTipoPersona" => 1,
            "nTipoDocumento" => 1,
            "cNroDocumento" => "79865412",
            "cCelular" => "956321478",
            "nEstado" => 1,
            "cUsuarioCreacion" => "74757790",
            "cUsuarioModificacion" => "74757790"
        ]);
    }
}
