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
}
