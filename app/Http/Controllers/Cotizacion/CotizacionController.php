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
            'cliente_id' =>$cotizacion->cliente_id , 
            'vendedor_id' =>$cotizacion->vendedor_id , 
            'clienteName' => $cotizacion->cliente->name . ' ' . $cotizacion->cliente->surname,
            'vendedorName' => $cotizacion->vendedor->name . ' ' . $cotizacion->vendedor->surname,
            'fechaEmision' => $cotizacion->fechaEmision,
            'fechaExpiracion' => $cotizacion->fechaExpiracion,
            'observaciones' => $cotizacion->observaciones,
            'total' => $cotizacion->total,
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
