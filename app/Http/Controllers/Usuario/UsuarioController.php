<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(Request $request)
    {
        $nEstado = $request->get("nEstado");
        if ($nEstado == 1 || $nEstado == 0) {
            $usuarios = User::where("nEstado", $nEstado)->orderBy("id", "desc")->get();
        } else {
            $usuarios = User::orderBy("id", "desc")->get();
        }

        return response()->json([
            "usuarios" => $usuarios,
        ]);
    }

    public function store(Request $request)
    {

        try {

            $usuario = User::create($request->all());
            return response()->json([
                "usuario" => $usuario,
                "success" => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al crear un usuario: ",
                "success" => false
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        try {

            $usuario->update($request->all());
            return response()->json([
                "usuario" => $usuario,
                "success" => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar el usuario: ",
                "success" => false
            ], 500);
        }
    }
}
