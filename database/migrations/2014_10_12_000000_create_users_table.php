<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('email', 191)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('avatar');
            $table->string('phone');
            $table->timestamp('birthday');
            $table->tinyInteger('gender');
            $table->tinyInteger('type_user');
            $table->tinyInteger('role_id');
            $table->tinyInteger('state');
            $table->rememberToken();
            $table->timestamps();
            $table->string('cUsuarioCreacion');
            $table->string('cUsuarioModificacion');
            $table->string('cNombres');
            $table->string('cApellidos');
            $table->string('cDocumento');
            $table->string('cAvatar');
            $table->string('cCelular');
            $table->timestamp('dFechaNacimiento');
            $table->tinyInteger('nGenero'); // 1 m 2 f
            $table->tinyInteger('nTipoUsuario'); // 1 cliemte, 2 empleado
            $table->tinyInteger('nRol'); // 1 admin
            $table->tinyInteger('nEstado');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
