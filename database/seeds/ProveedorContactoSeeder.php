<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProveedorContactoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $contactos = [
            [
                "proveedor_id" => 1,
                "cNombreCompleto" => "Juan Ramón García",
                "cCelular" => "978987678",
                "cCorreo" => "jramongarcia@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "84748474",
            ],
            [
                "proveedor_id" => 1,
                "cNombreCompleto" => "María López",
                "cCelular" => "976543210",
                "cCorreo" => "marialopez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "93847583",
            ],
            [
                "proveedor_id" => 1,
                "cNombreCompleto" => "Pedro Martínez",
                "cCelular" => "965432187",
                "cCorreo" => "pedromartinez@yahoo.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "74638291",
            ],
            [
                "proveedor_id" => 1,
                "cNombreCompleto" => "Ana García",
                "cCelular" => "954321876",
                "cCorreo" => "anagarcia@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "58392048",
            ],
            [
                "proveedor_id" => 1,
                "cNombreCompleto" => "Carlos Sánchez",
                "cCelular" => "943219876",
                "cCorreo" => "carlossanchez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "38475629",
            ],
            [
                "proveedor_id" => 2,
                "cNombreCompleto" => "Luisa Pérez",
                "cCelular" => "945678921",
                "cCorreo" => "luisaperez@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "57483920",
            ],
            [
                "proveedor_id" => 2,
                "cNombreCompleto" => "Javier Fernández",
                "cCelular" => "912345678",
                "cCorreo" => "javierfernandez@yahoo.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "38475639",
            ],
            [
                "proveedor_id" => 2,
                "cNombreCompleto" => "Elena Gutiérrez",
                "cCelular" => "923456789",
                "cCorreo" => "elenagutierrez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "92837465",
            ],
            [
                "proveedor_id" => 2,
                "cNombreCompleto" => "Mario Ruiz",
                "cCelular" => "934567890",
                "cCorreo" => "marioruiz@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "74839201",
            ],
            [
                "proveedor_id" => 2,
                "cNombreCompleto" => "Laura Martínez",
                "cCelular" => "965432187",
                "cCorreo" => "lauramartinez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "59384726",
            ],

            [
                "proveedor_id" => 3,
                "cNombreCompleto" => "Martín Sánchez",
                "cCelular" => "945678921",
                "cCorreo" => "martinsanchez@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "57483920",
            ],
            [
                "proveedor_id" => 3,
                "cNombreCompleto" => "Lucía Rodríguez",
                "cCelular" => "912345678",
                "cCorreo" => "luciarodriguez@yahoo.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "38475639",
            ],
            [
                "proveedor_id" => 3,
                "cNombreCompleto" => "Diego Pérez",
                "cCelular" => "923456789",
                "cCorreo" => "diegoperez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "92837465",
            ],
            [
                "proveedor_id" => 3,
                "cNombreCompleto" => "María García",
                "cCelular" => "934567890",
                "cCorreo" => "mariagarcia@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "74839201",
            ],
            [
                "proveedor_id" => 3,
                "cNombreCompleto" => "Carlos Martínez",
                "cCelular" => "965432187",
                "cCorreo" => "carlosmartinez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "59384726",
            ],

            [
                "proveedor_id" => 4,
                "cNombreCompleto" => "Alejandro López",
                "cCelular" => "945678921",
                "cCorreo" => "alejandrolopez@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "57483920",
            ],
            [
                "proveedor_id" => 4,
                "cNombreCompleto" => "Sofía Martínez",
                "cCelular" => "912345678",
                "cCorreo" => "sofiamartinez@yahoo.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "38475639",
            ],
            [
                "proveedor_id" => 4,
                "cNombreCompleto" => "Pablo González",
                "cCelular" => "923456789",
                "cCorreo" => "pablogonzalez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "92837465",
            ],
            [
                "proveedor_id" => 4,
                "cNombreCompleto" => "Ana Rodríguez",
                "cCelular" => "934567890",
                "cCorreo" => "anarodriguez@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "74839201",
            ],
            [
                "proveedor_id" => 4,
                "cNombreCompleto" => "Javier Sánchez",
                "cCelular" => "965432187",
                "cCorreo" => "javiersanchez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "59384726",
            ],

            [
                "proveedor_id" => 5,
                "cNombreCompleto" => "Isabel García",
                "cCelular" => "945678921",
                "cCorreo" => "isabelgarcia@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "57483920",
            ],
            [
                "proveedor_id" => 5,
                "cNombreCompleto" => "Miguel Martínez",
                "cCelular" => "912345678",
                "cCorreo" => "miguelmartinez@yahoo.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "38475639",
            ],
            [
                "proveedor_id" => 5,
                "cNombreCompleto" => "Carmen López",
                "cCelular" => "923456789",
                "cCorreo" => "carmenlopez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "92837465",
            ],
            [
                "proveedor_id" => 5,
                "cNombreCompleto" => "José Rodríguez",
                "cCelular" => "934567890",
                "cCorreo" => "joserodriguez@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "74839201",
            ],
            [
                "proveedor_id" => 5,
                "cNombreCompleto" => "Laura Sánchez",
                "cCelular" => "965432187",
                "cCorreo" => "laurasanchez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "59384726",
            ],

            [
                "proveedor_id" => 6,
                "cNombreCompleto" => "Andrea Rodríguez",
                "cCelular" => "945678921",
                "cCorreo" => "andrearodriguez@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "57483920",
            ],
            [
                "proveedor_id" => 6,
                "cNombreCompleto" => "Roberto López",
                "cCelular" => "912345678",
                "cCorreo" => "robertolopez@yahoo.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "38475639",
            ],
            [
                "proveedor_id" => 6,
                "cNombreCompleto" => "Sara Martínez",
                "cCelular" => "923456789",
                "cCorreo" => "saramartinez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "92837465",
            ],
            [
                "proveedor_id" => 6,
                "cNombreCompleto" => "Pablo García",
                "cCelular" => "934567890",
                "cCorreo" => "pablogarcia@gmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "74839201",
            ],
            [
                "proveedor_id" => 6,
                "cNombreCompleto" => "Ana Martínez",
                "cCelular" => "965432187",
                "cCorreo" => "anamartinez@hotmail.com",
                "nTipoDocumento" => 1,
                "cNroDocumento" => "59384726",
            ],

        ];

        foreach ($contactos as $contacto) {
            $contacto['nEstado'] = 1;
            $contacto['cUsuarioCreacion'] = '74757790';
            $contacto['cUsuarioModificacion'] = '74757790';
            $contacto['created_at'] = now();
            $contacto['updated_at'] = now();

            DB::table('proveedores_contactos')->insert($contacto);
        }
    }
}
