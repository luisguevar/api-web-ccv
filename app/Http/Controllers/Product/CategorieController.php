<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Models\Product\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class CategorieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $state = $request->get("state");

        if ($state != '0') {
            $categories = Categorie::where("state", $state)->orderBy("id", "desc")->get();
        } else {
            $categories = Categorie::orderBy("id", "desc")->get();
        }


        return response()->json([
            "categorias" => $categories,
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
        if ($request->hasFile("imagen_file")) {
            $path = Storage::putFile("categorias", $request->file("imagen_file"));
            $request->request->add(["imagen" => $path]);
        }
        $categorie = Categorie::create($request->all());
        return response()->json([
            "categorie" => $categorie,
        ]);
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
        $categorie = Categorie::findOrFail($id);
        if ($request->hasFile("imagen_file")) {
            if ($categorie->imagen) {
                Storage::delete($categorie->imagen);
            }
            $path = Storage::putFile("categorias", $request->file("imagen_file"));
            $request->request->add(["imagen" => $path]);
        }
        $categorie->update($request->all());
        return response()->json([
            "categorie" => $categorie,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();

        return response()->json(["message" => 200]);
    }

    public function remove(Request $request)
    {
        $categoria = Categorie::findOrFail($request->id);

        try {

            if ($categoria->state == 1) {
                $categoria->update([
                    'state' => 2
                ]);
            } 


            return response()->json(
                [
                    "message" => "categoria actualizada con éxito",
                    "id" => $categoria->id,
                    "estado" =>$categoria->state,
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
