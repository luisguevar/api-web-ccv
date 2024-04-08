<?php

namespace App\Http\Controllers\Producto;

use App\Http\Controllers\Controller;
use App\Models\Producto\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriaController extends Controller
{

    public function __construct()
    {
        /* $this->middleware('auth:api'); */
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
            $categorias = Categoria::where("nEstado", $nEstado)->orderBy("id", "desc")->get();
        } else {
            $categorias = Categoria::orderBy("id", "desc")->get();
        }

        return response()->json([
            "categorias" => $categorias,
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
            if ($request->hasFile("imagen_file")) {
                $path = Storage::putFile("categorias", $request->file("imagen_file"));
                $request->request->add(["cImagen" => $path]);
            }

            $categoria = Categoria::create($request->all());
            return response()->json([
                "categoria" => $categoria,
                "success" => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar la categoria: ",
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
        $categoria = Categoria::findOrFail($id);



        try {

            if ($request->hasFile("imagen_file")) {
                if ($categoria->imagen) {
                    Storage::delete($categoria->imagen);
                }
                $path = Storage::putFile("categorias", $request->file("imagen_file"));
                $request->request->add(["cImagen" => $path]);
            }

            $categoria->update($request->all());
            return response()->json([
                "categoria" => $categoria,
                "success" => true
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar la categoria: ",
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

    public function remove(Request $request)
    {
        $categoria = Categoria::findOrFail($request->id);

        try {

            $categoria->update([
                'nEstado' => 0
            ]);

            return response()->json(
                [
                    "message" => "categoria actualizada con éxito",
                    "id" => $categoria->id,
                    "estado" => $categoria->state,
                    "success" => true
                ],
                200
            );
        } catch (\Exception $e) {

            return response()->json([
                "error" => $e->getMessage(),
                "message" => "Error inesperado al actualizar la categoria: ",
                "success" => false
            ], 500);
        }
    }
}
