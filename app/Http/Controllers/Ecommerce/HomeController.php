<?php

namespace App\Http\Controllers\Ecommerce;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Producto\Producto;

class HomeController extends Controller
{

    public function home()
    {
        $productos = Producto::where("nEstado", "<>", 0)->orderBy("id", "desc")->get();
        return response()->json([

            "productos" => $productos->map(function ($producto) {

                return [
                    "id" => $producto->id,
                    "cImagen" => $producto->cImagen ? env("APP_URL") . "storage/" . $producto->cImagen : NULL,
                    "cCategoria"=>$producto->categorie->cDescripcion,
                    "cDescripcion"=>$producto->cDescripcion,
                    "cPrecio"=>$producto->nPrecioPEN
                ];
            }),




            "message" => 200,

        ]);
    }
}
