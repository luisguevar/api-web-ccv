<?php

namespace App\Http\Controllers\Proveedor;

use App\Http\Controllers\Controller;
use App\Http\Resources\Product\ProductCCollection;
use App\Models\Product\Product;
use App\Models\Proveedor\Proveedore;
use App\Models\Proveedor\ProveedoresContacto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function __construct()
    {
        /*   $this->middleware('auth:api'); */
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
            $proveedores = Proveedore::where("nEstado", $nEstado)->orderBy("id", "desc")->get();
        } else {
            $proveedores = Proveedore::orderBy("id", "desc")->get();
        }

        return response()->json([
            "proveedores" => $proveedores->map(function ($proveedor) {
                $nroContactos = $proveedor->contactos()->count();
                $nroProductos = $proveedor->productos()->count();
                // Limitar cActividadPrincipal a 40 caracteres y agregar "..." si es necesario
                $cActividadPrincipal = strlen($proveedor->cActividadPrincipal) > 38 ?
                    substr($proveedor->cActividadPrincipal, 0, 35) . "..." :
                    $proveedor->cActividadPrincipal;

                return [

                    "id" => $proveedor->id,
                    "nTipoPersona" => $proveedor->nTipoPersona,
                    "nTipoDocumento" => $proveedor->nTipoDocumento,
                    "cNroDocumento" => $proveedor->cNroDocumento,
                    "cRazonSocial" => $proveedor->cRazonSocial,
                    "cCelular" => $proveedor->cCelular,
                    "cCorreo" => $proveedor->cCorreo,
                    "cPaginaWeb" => $proveedor->cPaginaWeb,
                    "cDireccion" => $proveedor->cDireccion,
                    "cActividadPrincipal" => $cActividadPrincipal,
                    "cObservaciones" => $proveedor->cObservaciones,
                    "nEstado" => $proveedor->nEstado,
                    "nroContactos" => $nroContactos,
                    "nroProductos" => $nroProductos,

                ];
            }),
        ]);

        /*  $proveedores = Proveedore::orderBy("id", "desc")->where("estado", 1)->get();

        return response()->json([
            "proveedores" => $proveedores->map(function ($proveedor) {
                $nroContactos = $proveedor->contactos()->count();
                $nroProductos = $proveedor->productos()->count();

                return [

                    "id" => $proveedor->id,
                    "tipoPersona" => $proveedor->tipoPersona,
                    "tipoDocumento" => $proveedor->tipoDocumento,
                    "nroDocumento" => $proveedor->nroDocumento,
                    "razon_social" => $proveedor->razon_social,
                    "celular" => $proveedor->celular,
                    "correo" => $proveedor->correo,
                    "web" => $proveedor->web,
                    "direccion" => $proveedor->direccion,
                    "observaciones" => $proveedor->observaciones,
                    "estado" => $proveedor->estado,
                    "nroContactos" => $nroContactos,
                    "nroProductos" => $nroProductos,

                ];
            }),

        ]); */
    }

    public function store(Request $request)
    {

        try {
            $proveedor = Proveedore::create($request->all());
            return response()->json([
                "proveedor" => $proveedor,
                "success" => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al crear un proveedor ",
                "success" => false
            ], 500);
        }


        /*  try {
            DB::beginTransaction();
            // Crear un nuevo proveedor con los datos proporcionados
            $proveedor = new Proveedore([
                'tipoPersona' => $request->input('tipoPersona'),
                'tipoDocumento' => $request->input('tipoDocumento'),
                'nroDocumento' => $request->input('nroDocumento'),
                'razon_social' => $request->input('razon_social'),
                'celular' => $request->input('celular'),
                'correo' => $request->input('correo'),
                'web' => $request->input('web'),
                'direccion' => $request->input('direccion'),
                'observaciones' => $request->input('observaciones'),
                'estado' => $request->input('estado'),


            ]);

            // Guardar el nuevo proveedor en la base de datos
            $proveedor->save();
            $idProveedor = $proveedor->id;


            //guardar la lista de contactos

            $listContacto = $request->input('listContacto');


            foreach ($listContacto as $contacto) {
                $contacto['proveedor_id'] = $idProveedor;
                ProveedoresContacto::create($contacto);
            }
            DB::commit();


            return response()->json(
                [
                    "message" => "Proveedor creado con éxito",
                    "id" => $idProveedor,
                    "success" => true
                ],
                201
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al guardar el proveedor: ",
                "success" => false
            ], 500);
        } */
    }

    public function show($id)
    {
        $proveedor = Proveedore::findOrFail($id);
        //$contactos = ProveedoresContacto::orderBy("id", "desc")->where("proveedor_id", $id)->where("estado", 1)->get();
        /*   $productos = Product::orderBy("id", "desc")
            ->where("proveedor_id", $id)
            ->where(function ($query) {
                $query->where("state", 1)
                    ->orWhere('state', 2);
            })
            ->get();
 */

        return response()->json([
            "proveedor" =>  $proveedor,
            /*  "contactos" => $contactos, */
            /*   "productos" => ProductCCollection::make($productos), */
        ]);
    }

    public function update(Request $request)
    {
        $proveedor = Proveedore::findOrFail($request->id);

        try {

            $proveedor->update($request->all());
            return response()->json([
                "proveedor" => $proveedor,
                "success" => true
            ]);

            /* $proveedor->update([
                'tipoPersona' => $request->input('tipoPersona'),
                'tipoDocumento' => $request->input('tipoDocumento'),
                'nroDocumento' => $request->input('nroDocumento'),
                'razon_social' => $request->input('razon_social'),
                'celular' => $request->input('celular'),
                'correo' => $request->input('correo'),
                'web' => $request->input('web'),
                'direccion' => $request->input('direccion'),
                'observaciones' => $request->input('observaciones'),
                'actividad' => $request->input('actividad'),
                'estado' => $request->input('estado'),
            ]);

            // Insertar o actualizar los contactos asociados al proveedor
            $listContacto = $request->input('listContacto');
            foreach ($listContacto as $contacto) {
                $contacto['proveedor_id'] = $proveedor->id;

                if ($contacto['id'] > 0) {
                    // Actualizar el contacto existente
                    ProveedoresContacto::where('id', $contacto['id'])->update($contacto);
                } else {
                    // Crear un nuevo contacto
                    ProveedoresContacto::create($contacto);
                }
            }

            return response()->json(
                [
                    "message" => "Proveedor actualizado con éxito",
                    "id" => $proveedor->id,
                    "success" => true
                ],
                200
            ); */
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar el proveedor: ",
                "success" => false
            ], 500);
        }
    }

    public function remove(Request $request)
    {
        $proveedor = Proveedore::findOrFail($request->id);

        try {
            $proveedor->update([
                'nEstado' => 0
            ]);

            return response()->json(
                [
                    "message" => "proveedor actualizado con éxito",
                    "id" => $proveedor->id,
                    "success" => true
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar el proveedor: ",
                "success" => false
            ], 500);
        }
    }
}
