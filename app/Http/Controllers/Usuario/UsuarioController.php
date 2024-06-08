<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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

            // Realizar la búsqueda manual para el correo electrónico y el DNI
            $emailExists = User::where('email', $request->email)->where('nEstado', 1)->exists();
            $documentoExists = User::where('cDocumento', $request->cDocumento)->where('nEstado', 1)->exists();

            // Mensajes de error
            $errorMessage = '';

            if ($emailExists) {
                $errorMessage = 'El correo electrónico ya existe entre los usuarios activos. ';
            }

            if ($documentoExists) {
                $errorMessage = 'El DNI ya existe entre los usuarios activos. ';
            }

            if ($documentoExists && $emailExists) {
                $errorMessage = 'DNI y correo electrónico ya existentes entre los usuarios activos. ';
            }

            // Si hay errores, devolver la respuesta
            if ($emailExists || $documentoExists) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage ?: 'Datos proporcionados son inválidos.'
                ], 400); // Código de respuesta 400: Solicitud incorrecta
            }

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
        // Realizar la búsqueda manual para el correo electrónico y el DNI
        $emailExists = User::where('email', $request->email)->where('nEstado', 1)->where('id', '<>',  $id)->exists();
        $documentoExists = User::where('cDocumento', $request->cDocumento)->where('nEstado', 1)->where('id', '<>',  $id)->exists();

        // Mensajes de error
        $errorMessage = '';

        if ($emailExists) {
            $errorMessage = 'El correo electrónico ya existe entre los usuarios activos. ';
        }

        if ($documentoExists) {
            $errorMessage = 'El DNI ya existe entre los usuarios activos. ';
        }

        if ($documentoExists && $emailExists) {
            $errorMessage = 'DNI y correo electrónico ya existentes entre los usuarios activos. ';
        }

        // Si hay errores, devolver la respuesta
        if ($emailExists || $documentoExists) {
            return response()->json([
                'success' => false,
                'message' => $errorMessage ?: 'Datos proporcionados son inválidos.'
            ], 400); // Código de respuesta 400: Solicitud incorrecta
        }


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
