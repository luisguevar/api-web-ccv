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
        $cotizaciones = Cotizacione::orderBy("id", "desc")->get();
        return response()->json([
            "cotizaciones" => $cotizaciones,
        ]);
    }
}
