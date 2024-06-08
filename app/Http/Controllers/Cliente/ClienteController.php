<?php

namespace App\Http\Controllers\Cliente;

use Illuminate\Http\Request;
use App\Models\Cliente\Cliente;
use App\Http\Controllers\Controller;


class ClienteController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nEstado = $request->get("nEstado");
        if ($nEstado == 1 || $nEstado == 0) {
            $clientes = Cliente::where("nEstado", $nEstado)->orderBy("id", "desc")->get();
        } else {
            $clientes = Cliente::orderBy("id", "desc")->get();
        }

        return response()->json([
            "clientes" => $clientes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {

            // Realizar la búsqueda manual para el correo electrónico y el DNI
            $emailExists = Cliente::where('cCorreo', $request->cCorreo)->where('nEstado', 1)->exists();
            $documentoExists = Cliente::where('cNroDocumento', $request->cNroDocumento)->where('nEstado', 1)->exists();

            // Mensajes de error
            $errorMessage = '';

            if ($emailExists) {
                $errorMessage = 'El correo electrónico ya existe entre los clientes activos. ';
            }

            if ($documentoExists) {
                $errorMessage = 'El DNI ya existe entre los clientes activos. ';
            }

            if ($documentoExists && $emailExists) {
                $errorMessage = 'DNI y correo electrónico ya existentes entre los clientes activos. ';
            }

            // Si hay errores, devolver la respuesta
            if ($emailExists || $documentoExists) {
                return response()->json([
                    'success' => false,
                    'message' => $errorMessage ?: 'Datos proporcionados son inválidos.'
                ], 400); // Código de respuesta 400: Solicitud incorrecta
            }

            $cliente = Cliente::create($request->all());
            return response()->json([
                "cliente" => $cliente,
                "success" => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al crear un cliente",
                "success" => false
            ], 500);
        }
    }
    //

    public function remove(Request $request)
    {
        $cliente = Cliente::findOrFail($request->id);

        try {
            $cliente->update([
                'estado' => 0
            ]);

            return response()->json(
                [
                    "message" => "cliente actualizado con éxito",
                    "id" => $cliente->id,
                    "success" => true
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar el cliente. ",
                "success" => false
            ], 500);
        }
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       // Realizar la búsqueda manual para el correo electrónico y el DNI
       $emailExists = Cliente::where('cCorreo', $request->cCorreo)->where('nEstado', 1)->where('id', '<>',  $id)->exists();
       $documentoExists = Cliente::where('cNroDocumento', $request->cNroDocumento)->where('nEstado', 1)->where('id', '<>',  $id)->exists();

       // Mensajes de error
       $errorMessage = '';

       if ($emailExists) {
           $errorMessage = 'El correo electrónico ya existe entre los clientes activos. ';
       }

       if ($documentoExists) {
           $errorMessage = 'El DNI ya existe entre los clientes activos. ';
       }

       if ($documentoExists && $emailExists) {
           $errorMessage = 'DNI y correo electrónico ya existentes entre los clientes activos. ';
       }

       // Si hay errores, devolver la respuesta
       if ($emailExists || $documentoExists) {
           return response()->json([
               'success' => false,
               'message' => $errorMessage ?: 'Datos proporcionados son inválidos.'
           ], 400); // Código de respuesta 400: Solicitud incorrecta
       }


       $cliente = Cliente::findOrFail($id);

       try {

           $cliente->update($request->all());
           return response()->json([
               "cliente" => $cliente,
               "success" => true
           ]);
       } catch (\Exception $e) {

           return response()->json([
               "error" => $e->getMessage(),
               "message" => "Error inesperado al actualizar el cliente ",
               "success" => false
           ], 500);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        try {
            $cliente->update([
                'estado' => 0
            ]);

            return response()->json(
                [
                    "message" => "cotizacion actualizado con éxito",
                    "id" => $cliente->id,
                    "success" => true
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar el cotizacion: ",
                "success" => false
            ], 500);
        }
    }
}
