<?php

namespace App\Http\Controllers\Cotizacion;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use App\Models\Product\Product;
use App\Models\Cotizacion\Cotizacione;
use App\Models\Cotizacion\CotizacionesProducto;
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
        $estadoCotizacion = $request->input('estadoCotizacion');

        $query = Cotizacione::orderBy("id", "desc")->with('cliente')->with('vendedor')->where("estado", 1);
        if ($estadoCotizacion != 0) {
            $query->where('estadoCotizacion', $estadoCotizacion);
        }

        $lst_cotizaciones = $query->get();


        $cotizaciones = $lst_cotizaciones->map(function ($cotizacion) {
            // Verificar si la relación 'cliente' existe
            if ($cotizacion->cliente) {
                $clienteName = $cotizacion->cliente->nombres . ' ' . $cotizacion->cliente->apellidos;
            } else {
                $clienteName = 'Cliente no disponible';
            }

            // Verificar si la relación 'vendedor' existe
            if ($cotizacion->vendedor) {
                $vendedorName = $cotizacion->vendedor->name . ' ' . $cotizacion->vendedor->surname;
            } else {
                $vendedorName = 'Vendedor no disponible';
            }

            return [
                'id' => $cotizacion->id,
                'clienteName' => $clienteName,
                'vendedorName' => $vendedorName,
                'fechaEmision' => $cotizacion->fechaEmision,
                'fechaExpiracion' => $cotizacion->fechaExpiracion,
                'total' => $cotizacion->total,
                'estado' => $cotizacion->estadoCotizacion,
            ];
        });


        return response()->json([
            "cotizaciones" => $cotizaciones,
        ]);
    }

    public function show($id)
    {
        $cotizacion = Cotizacione::with('cliente', 'vendedor')->findOrFail($id);
        $productos = CotizacionesProducto::orderBy("id", "desc")->where("cotizacion_id", $id)->where("estado", 1)->get();

        // $productos = [
        //     'cantidad' => $producto->cantidad,
        //     'cotizacion_id' =>$producto->cotizacion_id , 
        //     'producto_id' =>$producto->producto_id , 
        //     'precio' => $producto->precio,
        //     'total' => $producto->precio * $producto->cantidad,
        //     'estado' => $producto->estado,


        //     'created_at' => $producto->created_at,
        //     'updated_at' => $producto->updated_at,


        // ];
        $cotizaciones = [
            'id' => $cotizacion->id,
            'cliente_id' => $cotizacion->cliente_id,
            'vendedor_id' => $cotizacion->vendedor_id,
            'clienteName' => $cotizacion->cliente->nombres . ' ' . $cotizacion->cliente->apellidos,
            'vendedorName' => $cotizacion->vendedor->name . ' ' . $cotizacion->vendedor->surname,
            'fechaEmision' => $cotizacion->fechaEmision,
            'fechaExpiracion' => $cotizacion->fechaExpiracion,
            'observaciones' => $cotizacion->observaciones,
            'total' => $cotizacion->total,
            'tieneDescuento' => $cotizacion->tieneDescuento,
            'descuento' => $cotizacion->descuento,
            'estado' => $cotizacion->estado,
        ];

        $cotizacion = cotizacione::findOrFail($id);

        return response()->json([
            "cotizacion" =>  $cotizaciones,
            "productos" =>  $productos
        ]);
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // Crear un nuevo proveedor con los datos proporcionados
            $cotizacion = new Cotizacione([
                'cliente_id' => $request->input('cliente_id'),
                'vendedor_id' => $request->input('vendedor_id'),
                'estado' => $request->input('estado'),
                'fechaEmision' => $request->input('fechaEmision'),
                'fechaExpiracion' => $request->input('fechaExpiracion'),
                'observaciones' => $request->input('observaciones'),
                'estadoCotizacion' => $request->input('estadoCotizacion'),
                'tieneDescuento' => $request->input('tieneDescuento'),
                'descuento' => $request->input('descuento'),
                'total' => $request->input('total'),
            ]);

            // Guardar el nuevo cotizacion en la base de datos
            $cotizacion->save();
            $idcotizacion = $cotizacion->id;

            $listProducto = $request->input('listProducto');
            //guardar la lista de contactos
            foreach ($listProducto as $producto) {
                $producto['cotizacion_id'] = $idcotizacion;
                CotizacionesProducto::create($producto);
            }

            DB::commit();
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

    public function update(Request $request)
    {
        $cotizacion = Cotizacione::findOrFail($request->id);

        try {
            $cotizacion->update([
                'cliente_id' => $request->input('cliente_id'),
                'vendedor_id' => $request->input('vendedor_id'),
                'estado' => $request->input('estado'),
                'fechaEmision' => $request->input('fechaEmision'),
                'fechaExpiracion' => $request->input('fechaExpiracion'),
                'observaciones' => $request->input('observaciones'),
                'estadoCotizacion' => $request->input('estadoCotizacion'),
                'tieneDescuento' => $request->input('tieneDescuento'),
                'descuento' => $request->input('descuento'),
                'total' => $request->input('total'),
            ]);
            $listProducto = $request->input('listProducto');
            foreach ($listProducto as $producto) {
                $producto['cotizacion_id'] = $cotizacion->id;

                if ($producto['id'] > 0) {
                    // Actualizar el contacto existente
                    CotizacionesProducto::where('id', $producto['id'])->update($producto);
                } else {
                    // Crear un nuevo contacto
                    CotizacionesProducto::create($producto);
                }
            }
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

    public function remove(Request $request)
    {
        $cotizacion = Cotizacione::findOrFail($request->id);

        try {
            $cotizacion->update([
                'estado' => 0
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
}
