<?php

namespace App\Http\Controllers\Venta;

use App\Http\Controllers\Controller;
use App\Models\Venta\DetalleVenta;
use App\Models\Venta\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nEstado = $request->input('nEstado', -1);
        $cCorrelativo = $request->input('cCorrelativo', null);
        $startDate = $request->input('dFechaInicio', null);
        $endDate = $request->input('dFechaFin', null);

        // Llamar al procedimiento almacenado con los parámetros
        $ventas = DB::select('CALL SP_GETALLVENTAS(?, ?, ?, ?)', [$nEstado, $cCorrelativo, $startDate, $endDate]);

        return response()->json([
            "message" => 200,
            "ventas" => $ventas,
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
            DB::beginTransaction();

            // Crear la cotización y obtener el ID
            $venta = Venta::create($request->all());

            // Obtener año y mes actuales
            $year = now()->format('y'); // Año en formato 2 dígitos
            $month = now()->format('m'); // Mes en formato 2 dígitos

            // Obtener el ID de la cotización
            $id = $venta->id;

            // Rellenar el ID a 6 dígitos
            $idPadded = str_pad($id, 6, '0', STR_PAD_LEFT);

            // Generar el correlativo concatenando año, mes y el ID rellenado
            $correlativo = $year . $month . $idPadded;

            // Actualizar la cotización con el correlativo
            $venta->cCorrelativo = $correlativo;
            $venta->dFechaVenta = now();
            $venta->save();


            $listProductos = $request->input('listProductos');
            foreach ($listProductos as $producto) {

                DetalleVenta::create([
                    "nCantidad" => $producto['nCantidad'],
                    "nPrecioUnitario" =>  $producto['nPrecioUnitario'],
                    "nDescuento" => $producto['nDescuento'],
                    "nEstado" => $producto['nEstado'],
                    "cUsuarioCreacion" => $producto['cUsuarioCreacion'],
                    "cUsuarioModificacion" => $producto['cUsuarioModificacion'],
                    "venta_id" => $venta->id,
                    "producto_id" => $producto['producto_id'],
                ]);
            }


            DB::commit();
            return response()->json(
                [
                    "message" => "Venta creada con éxito",
                    "venta" => $venta,
                    "success" => true
                ],
                201
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al guardar la venta: ",
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
        $venta = Venta::with('cliente', 'vendedor')->findOrFail($id);
        $productos = DetalleVenta::orderBy("id", "asc")->where("venta_id", $id)->where("nEstado", 1)->get();

        $result = []; // Inicializa un array para almacenar los resultados

        foreach ($productos as $producto) {
            $result[] = [
                'id' => $producto->id,
                'venta_id' => $producto->venta_id,
                'producto_id' => $producto->producto_id,
                'nCantidad' => $producto->nCantidad,
                'nPrecioUnitario' => $producto->nPrecioUnitario,
                'nDescuento' => $producto->nDescuento,
                'nEstado' => $producto->nEstado,
                'cUsuarioCreacion' => $producto->cUsuarioCreacion,
                'cUsuarioModificacion' => $producto->cUsuarioModificacion,
                'producto_nombre' => $producto->product->cDescripcion,
                'nTotalConDescuento' => number_format((100 - $producto->nDescuento) * ($producto->nCantidad * $producto->nPrecioUnitario) / 100, 2),
                'nTotalSinDescuento' => number_format(($producto->nCantidad * $producto->nPrecioUnitario), 2),
                'nTotalDescuento'=>number_format(($producto->nDescuento) * ($producto->nCantidad * $producto->nPrecioUnitario) / 100, 2),
            ];
        }

        $detalle_venta = [
            'id' => $venta->id,
            'cCorrelativo' => $venta->cCorrelativo,
            'nTipoOrigen' => $venta->nTipoOrigen,
            'cliente_id' => $venta->cliente_id,
            'vendedor_id' => $venta->vendedor_id,
            'dFechaVenta' => $venta->dFechaVenta,
            'cNombreCliente' => $venta->cliente->cNombres . ' ' . $venta->cliente->cApellidos,
            'cClienteCorreo' => $venta->cliente->cNombres . ' ' . $venta->cliente->cApellidos . ' / ' . $venta->cliente->cCorreo,
            'cVendedorCorreo' => $venta->vendedor->cNombres . ' ' . $venta->vendedor->cApellidos . ' / ' . $venta->vendedor->email,
            'cObservaciones' => $venta->cObservaciones,
            'nTipoComprobante' => $venta->nTipoComprobante,
            'nTipoPago' => $venta->nTipoPago,
            'nEfectivoRecibido' => $venta->nEfectivoRecibido,
            'bEfectivoExacto' => $venta->bEfectivoExacto,
            'nVuelto' => $venta->nVuelto,
            'cCodigoOperacion' => $venta->cCodigoOperacion,
            'nSubTotal' => $venta->nSubTotal,
            'IGV' => $venta->IGV,
            'nValorIGV' => $venta->nValorIGV,
            'nDescuento' => $venta->nDescuento,
            'nTotal' => $venta->nTotal,
            'nEstado' => $venta->nEstado,
            'bCompletado' => $venta->bCompletado,
            'cObservaciones' => $venta->cObservaciones
        ];
        return response()->json([
            "detalle_venta" =>  $detalle_venta,
            "listProductos" =>  $result
        ]);
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
        $venta = Venta::findOrFail($request->id);
        try {
            $venta->update([
                'nEstado' => $request->nEstado,
                'bCompletado'=>  $request->bCompletado,
                'cUsuarioModificacion'=> $request->cUsuarioModificacion,
            ]);

            return response()->json(
                [
                    "message" => "Pedido actualizado con éxito",
                    "id" => $venta->id,
                    "success" => true
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar el estado del Pedido: ",
                "success" => false
            ], 500);
        }
    }

    public function cancelar(Request $request, $id)
    {
        $venta = Venta::findOrFail($request->id);

        try {
            $venta->update([
                'nEstado' => 5,
                'cObservaciones' => $request->cObservaciones
            ]);

            return response()->json(
                [
                    "message" => "Pedido actualizado con éxito",
                    "id" => $venta->id,
                    "success" => true
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al cancelar el Pedido: ",
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
        //
    }
}
