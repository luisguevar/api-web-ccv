<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductCCollection;
use App\Http\Resources\Product\ProductCResource;
use App\Models\Producto\Producto;
use App\Models\Product\ProductImage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $nEstado = $request->get("nEstado");
        if ($nEstado == -1) {
            $productos = Producto::orderBy("id", "desc")->get();
        } else {
            $productos = Producto::where("nEstado", $nEstado)->orderBy("id", "desc")->get();
        }

        return response()->json([
            "message" => 200,
            "productos" => ProductCCollection::make($productos),
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
            $existe_producto = Producto::where("cDescripcion", $request->cDescripcion)->first();
            if ($existe_producto) {
                return response()->json(["message" => 403]);
            }
            $request->request->add(["cSlug" => Str::slug($request->cDescripcion)]);
            if ($request->hasFile("imagen_file")) {
                $path = Storage::putFile("productos", $request->file("imagen_file"));
                $request->request->add(["cImagen" => $path]);
            }
            $producto = Producto::create($request->all());
            foreach ($request->file("files") as $key => $file) {
                $extension = $file->getClientOriginalExtension();
                $size = $file->getSize();
                $nombre = $file->getClientOriginalName();

                $path = Storage::putFile("productos", $file);
                ProductImage::create([
                    "product_id" => $producto->id,
                    "file_name" => $nombre,
                    "imagen" => $path,
                    "size" => $size,
                    "type" => $extension,
                ]);
            }


            return response()->json([
                "producto" => $producto,
                "success" => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al crear un producto ",
                "success" => false
            ], 500);
        }



        /*  
        foreach ($request->file("files") as $key => $file) {
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $nombre = $file->getClientOriginalName();

            $path = Storage::putFile("productos", $file);
            ProductImage::create([
                "product_id" => $product->id,
                "file_name" => $nombre,
                "imagen" => $path,
                "size" => $size,
                "type" => $extension,
            ]);
            } 
        */

        /*  return response()->json(["message" => 200]); */
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $producto = Producto::findOrFail($id);

        return response()->json([
            "product" => ProductCResource::make($producto),
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
        try {

            $existe_producto = Producto::where("id", "<>", $id)->where("cDescripcion", $request->cDescripcion)->first();
            if ($existe_producto) {
                return response()->json(["message" => 403]);
            }

            $producto = Producto::findOrFail($id);


            $request->request->add(["cSlug" => Str::slug($request->cDescripcion)]);
            if ($request->hasFile("imagen_file")) {
                $path = Storage::putFile("productos", $request->file("imagen_file"));
                $request->request->add(["cImagen" => $path]);
            }
            $producto->update($request->all());



            return response()->json([
                "producto" => $producto,
                "success" => true
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar un producto ",
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



    public function addImagen(Request $request)
    {
        $file = $request->file("file");
        if ($request->hasFile("file")) {
            $extension = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $nombre = $file->getClientOriginalName();

            $path = Storage::putFile("productos", $file);
            $imagen = ProductImage::create([
                "product_id" => $request->product_id,
                "file_name" => $nombre,
                "imagen" => $path,
                "size" => $size,
                "type" => $extension,
            ]);
        }

        return response()->json([
            "imagen" => [
                "id" => $imagen->id,
                "file_name" => $imagen->file_name,
                "imagen" => env("APP_URL") . "storage/" . $imagen->imagen,
                "size" => $imagen->size,
                "type" => $imagen->type,
            ]
        ]);
    }

    public function removeImagen($id)
    {
        $imagen = ProductImage::findOrFail($id);
        if ($imagen->imagen) {
            Storage::delete($imagen->imagen);
        }
        $imagen->delete();
        return response()->json(["message" => 200]);
    }
}
