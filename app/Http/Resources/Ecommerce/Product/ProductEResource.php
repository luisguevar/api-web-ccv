<?php

namespace App\Http\Resources\Ecommerce\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductEResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // logica de descuento
        /*   $discount_g = null;
        if($this->resource->discount_p && $this->resource->discount_c){
            $discount_g =$this->resource->discount_p;
        }else{
            if($this->resource->discount_p && !$this->resource->discount_c){
                $discount_g =$this->resource->discount_p;
            }else{
                if(!$this->resource->discount_p && $this->resource->discount_c){
                    $discount_g =$this->resource->discount_c;
                }
            }
        } */
        return [
            "id" => $this->id,
            "title" => $this->resource->cDescripcion,
            "categorie_id" => $this->resource->categoria_id,
            "categorie" => [
                "id" => optional($this->resource->categorie)->id,
                "icono" => optional($this->resource->categorie)->cIcono,
                "name" => optional($this->resource->categorie)->cDescripcion,
            ],
            "slug" => $this->resource->cSlug,
            "sku" => $this->resource->cSku,
            "price_soles" => $this->resource->nPrecioPEN,
            "price_usd" => $this->resource->nPrecioUSD,
            "resumen" => $this->resource->cResumen,
            "description" => $this->resource->cDescripcionDetallada,
            "imagen" => env("APP_URL") . "storage/" . $this->resource->cImagen,
            "stock" => $this->resource->nStock,
           /*  "checked_inventario" => $this->resource->type_inventario, */
            "reviews_count" => $this->resource->reviews_count,
            "avg_rating" => round($this->resource->avg_rating),
            // "discount_p" => $this->resource->discount_p,
            // "discount_c" => $this->resource->discount_c,
            /*   "discount_g" => $discount_g, */
            "images" => $this->resource->images->map(function ($img) {
                return [
                    "id" => $img->id,
                    "file_name" => $img->file_name,
                    "imagen" => env("APP_URL") . "storage/" . $img->imagen,
                    "size" => $img->size,
                    "type" => $img->type,
                ];
            }),
            /*   "sizes" => $this->resource->sizes->map(function($size){
                return [
                    "id" => $size->id,
                    "name" => $size->name,
                    "total" => $size->product_size_colors->sum("stock"),
                    "variaciones" => $size->product_size_colors->map(function($var){
                        return [
                            "id" => $var->id,
                            "product_color_id" => $var->product_color_id,
                            "product_color" => $var->product_color,
                            "stock" => $var->stock,
                        ];
                    }),
                ];
            }), */
        ];
    }
}
