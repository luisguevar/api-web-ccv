<?php

namespace App\Http\Controllers\Cotizacion;

use App\Http\Controllers\Controller;
use App\Models\Cotizacion\Cotizacione;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    //
    public function index()
    {
        $lst_cotizaciones = Cotizacione::orderBy("id", "desc")->with('cliente')->with('vendedor')->get();

        $cotizaciones = $lst_cotizaciones->map(function ($cotizacion) {
            return [
                'id' => $cotizacion->id,
                'clienteName' => $cotizacion->cliente->name . ' ' . $cotizacion->cliente->surname,
                'vendedorName' => $cotizacion->vendedor->name . ' ' . $cotizacion->vendedor->surname,
                'fechaEmision' => $cotizacion->fechaEmision,
                'fechaExpiracion' => $cotizacion->fechaExpiracion,
                'total' => $cotizacion->total,
                'estado' => $cotizacion->estado,
            ];
        });

        return response()->json([
            "cotizaciones" => $cotizaciones,
        ]);
        
    }

    public function show($id)
    {
        $cotizacion = cotizacione::findOrFail($id);
        
        return response()->json([
            "cotizacion" =>  $cotizacion
        ]);
    }
    public function store(Request $request)
    {
        try {
           
            // Crear un nuevo proveedor con los datos proporcionados
            $cotizacion = new Cotizacione([
                'cliente_id' => $request->input('cliente_id'),
                'vendedor_id' => $request->input('vendedor_id'),
                'estado' => $request->input('estado'),
                'fechaEmision' => $request->input('fechaEmision'),
                'fechaExpiracion' => $request->input('fechaExpiracion'),
                'observaciones' => $request->input('observaciones'),
                'estadoCotizacion' => $request->input('estadoCotizacion'),
                'total' => $request->input('total'),
            ]);

            // Guardar el nuevo cotizacion en la base de datos
            $cotizacion->save();
            $idcotizacion = $cotizacion->id;


            //guardar la lista de contactos



            return response()->json(
                [
                    "message" => "Cotizacion creada con éxito",
                    "id" => $idcotizacion,
                    "success" => true
                ],
                201
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al guardar la cotizacion: ",
                "success" => false
            ], 500);
        }
    }

}
