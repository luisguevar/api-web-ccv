<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'cNombres' => 'Luis A.',
                'cApellidos' => 'Guevara Aredo',
                'cDocumento' => '74757790',
                'cAvatar' => 'avatar.jpg',
                'cCelular' => '9678965345',
                'dFechaNacimiento' => Carbon::now()->subYears(20),
                'nGenero' => 1, // 1 para masculino
                'nTipoUsuario' => 2, // 1 para cliente ecommerce 2 par usuario administrador
                'nRol' => 1, // 1 para administrador, otro no definidos
                'nEstado' => 1, // 1 para activo

                'name' => 'Luis A.',
                'surname' => 'Guevara Aredo',
                'email' => 'lguevara@correo.com',
                'password' => '12345678',
                'type_user' => 2,
                'state' => 1,
                'role_id' => 1

            ],

            [
                'cNombres' => 'José Antonio',
                'cApellidos' => 'Martinez Gutierrez',
                'cDocumento' => '79866545',
                'cAvatar' => 'avatar.jpg',
                'cCelular' => '967895756',
                'dFechaNacimiento' => Carbon::now()->subYears(20),
                'nGenero' => 1, // 1 para masculino
                'nTipoUsuario' => 1, // 1 para cliente ecommerce 2 par usuario administrador
                'nRol' => 0, // 1 para administrador, otro no definidos
                'nEstado' => 1, // 1 para activo

                'name' => 'José Antonio',
                'surname' => 'Martinez Gutierrez',
                'email' => 'josecliente@correo.com',
                'password' => '12345678',
                'type_user' => 1,
                'state' => 1,
                'role_id' => 1

            ]
        );
    }
}
