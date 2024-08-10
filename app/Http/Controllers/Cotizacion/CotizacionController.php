<?php

namespace App\Http\Controllers\Cotizacion;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use App\Models\Product\Product;
use App\Models\Cotizacion\Cotizacione;
use App\Models\Cotizacion\CotizacionesProducto;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CotizacionController extends Controller
{
    public function __construct()
    {
        /*  $this->middleware('auth:api'); */
    }
    //
    public function index(Request $request)
    {

        $nEstado = $request->input('nEstado', -1);
        $cCorrelativo = $request->input('cCorrelativo', null);
        $startDate = $request->input('dFechaEmisionInicio', null);
        $endDate = $request->input('dFechaEmisionFin', null);

        // Llamar al procedimiento almacenado con los parámetros
        $cotizaciones = DB::select('CALL SP_GETALLCOTIZACIONES(?, ?, ?, ?)', [$nEstado, $cCorrelativo, $startDate, $endDate]);

        return response()->json([
            "message" => 200,
            "cotizaciones" => $cotizaciones,
        ]);
    }

    public function show($id)
    {
        $cotizacion = Cotizacione::with('cliente', 'vendedor')->findOrFail($id);
        $productos = CotizacionesProducto::orderBy("id", "asc")->where("cotizacion_id", $id)->where("nEstado", 1)->get();

        $result = []; // Inicializa un array para almacenar los resultados

        foreach ($productos as $producto) {
            $result[] = [
                'id' => $producto->id,
                'cotizacion_id' => $producto->cotizacion_id,
                'producto_id' => $producto->producto_id,
                'nCantidad' => $producto->nCantidad,
                'nPrecioUnitario' => $producto->nPrecioUnitario,
                'nDescuento' => $producto->nDescuento,
                'nEstado' => $producto->nEstado,
                'cUsuarioCreacion' => $producto->cUsuarioCreacion,
                'cUsuarioModificacion' => $producto->cUsuarioModificacion,
                'nTotalConDescuento' => number_format((100 - $producto->nDescuento) * ($producto->nCantidad * $producto->nPrecioUnitario) / 100, 2),
                'nTotalSinDescuento' => number_format(($producto->nCantidad * $producto->nPrecioUnitario), 2),
                'nTotalDescuento'=>number_format(($producto->nDescuento) * ($producto->nCantidad * $producto->nPrecioUnitario) / 100, 2),
                'producto_nombre' => $producto->product->cDescripcion,
            ];
        }




        $cotizaciones = [
            'id' => $cotizacion->id,
            'cliente_id' => $cotizacion->cliente_id,
            'vendedor_id' => $cotizacion->vendedor_id,
            'cNombreCliente' => $cotizacion->cliente->cNombres . ' ' . $cotizacion->cliente->cApellidos,
            'cClienteCorreo' => $cotizacion->cliente->cNombres . ' ' . $cotizacion->cliente->cApellidos . ' / ' . $cotizacion->cliente->cCorreo,
            'dFechaEmision' => $cotizacion->dFechaEmision,
            'dFechaExpiracion' => $cotizacion->dFechaExpiracion,
            'cObservaciones' => $cotizacion->cObservaciones,
            'cCorrelativo' => $cotizacion->cCorrelativo,
            'nEstado' => $cotizacion->nEstado,
        ];

        $cotizacion = cotizacione::findOrFail($id);

        return response()->json([
            "cotizacion" =>  $cotizaciones,
            "listProductos" =>  $result
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Crear la cotización y obtener el ID
            $cotizacion = Cotizacione::create($request->all());

            // Obtener año y mes actuales
            $year = now()->format('y'); // Año en formato 2 dígitos
            $month = now()->format('m'); // Mes en formato 2 dígitos

            // Obtener el ID de la cotización
            $id = $cotizacion->id;

            // Rellenar el ID a 6 dígitos
            $idPadded = str_pad($id, 6, '0', STR_PAD_LEFT);

            // Generar el correlativo concatenando año, mes y el ID rellenado
            $correlativo = $year . $month . $idPadded;

            // Actualizar la cotización con el correlativo
            $cotizacion->cCorrelativo = $correlativo;
            $cotizacion->save();


            $listProductos = $request->input('listProductos');
            foreach ($listProductos as $producto) {

                CotizacionesProducto::create([
                    "nCantidad" => $producto['nCantidad'],
                    "nPrecioUnitario" =>  $producto['nPrecioUnitario'],
                    "nDescuento" => $producto['nDescuento'],
                    "nEstado" => $producto['nEstado'],
                    "cUsuarioCreacion" => $producto['cUsuarioCreacion'],
                    "cUsuarioModificacion" => $producto['cUsuarioModificacion'],
                    "cotizacion_id" => $cotizacion->id,
                    "producto_id" => $producto['producto_id'],
                ]);
            }


            DB::commit();
            return response()->json(
                [
                    "message" => "Cotizacion creada con éxito",
                    "cotizacion" => $cotizacion,
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

    public function update(Request $request)
    {
        $cotizacion = Cotizacione::findOrFail($request->id);

        try {

            DB::beginTransaction();
            $cotizacion->update($request->all());

            $listProductos = $request->input('listProductos');
            foreach ($listProductos as $producto) {
                $producto['cotizacion_id'] = $cotizacion->id;

                if ($producto['id'] > 0) {

                    CotizacionesProducto::where('id', $producto['id'])->update([
                        "nEstado" => $producto['nEstado'],
                        "cUsuarioModificacion" => $producto['cUsuarioModificacion']
                    ]);
                } else {

                    CotizacionesProducto::create([
                        "nCantidad" => $producto['nCantidad'],
                        "nPrecioUnitario" => $producto['nPrecioUnitario'],
                        "nDescuento" => $producto['nDescuento'],
                        "nEstado" => $producto['nEstado'],
                        "cUsuarioCreacion" => $producto['cUsuarioCreacion'],
                        "cUsuarioModificacion" => $producto['cUsuarioModificacion'],
                        "cotizacion_id" => $cotizacion->id,
                        "producto_id" => $producto['producto_id'],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                "cotizacion" => $cotizacion,
                "success" => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar la cotizacion: ",
                "success" => false
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $cotizacion = Cotizacione::findOrFail($request->id);

        try {
            $cotizacion->update([
                'nEstado' => 0
            ]);

            return response()->json(
                [
                    "message" => "cotizacion actualizado con éxito",
                    "id" => $cotizacion->id,
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

    public function allClientes()
    {
        $clientes = Cliente::orderBy("id", "desc")->get();
        return response()->json([
            "clientes" => $clientes,
        ]);
    }

    public function allProductos()
    {
        $productos = Product::orderBy("id", "desc")->get();
        return response()->json([
            "productos" => $productos,
        ]);
    }

    /*  public function addClienteRapido(Request $request)
    {
        try {

            $cliente = Cliente::create($request->all());

            return response()->json(
                [
                    "message" => "Cliente creado con éxito",
                    "cliente" => $cliente,
                    "success" => true
                ],
                201
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al crear el cliente: ",
                "success" => false
            ], 500);
        }
    } */
}
