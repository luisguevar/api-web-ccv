<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "cDescripcion" => $this->resource->cDescripcion,
            "categoria_id" => $this->resource->categoria_id,
            "cImagen" => env("APP_URL") . "storage/" . $this->resource->cImagen,
            //"cCategoria"=>$this->resource->categorie->cDescripcion,
            "nPrecioPEN" => $this->resource->nPrecioPEN,
            "nPrecioUSD" => $this->resource->nPrecioUSD,
            "nEstado" => $this->resource->nEstado,
            "categoria" => [
                "id" => $this->resource->categorie->id,
                "cIcono" => $this->resource->categorie->cIcono,
                "cDescripcion" => $this->resource->categorie->cDescripcion,
            ],
            "cSku" => $this->resource->cSku,
            "nPrecioPEN" => $this->resource->nPrecioPEN,
            "nPrecioUSD" => $this->resource->nPrecioUSD,
            "nStock" => $this->resource->nStock,
            "cResumen" => $this->resource->cResumen,
            "cDescripcionDetallada" => $this->resource->cDescripcionDetallada,
            /* "cImagen" => $this->resource->cImagen, */
            "cImagen" => env("APP_URL")."storage/".$this->resource->cImagen,
            "nPrecioCompra" => $this->resource->nPrecioCompra,
            "dFechaCompra" => $this->resource->dFechaCompra,
            "images" => $this->resource->images->map(function($img){
                return [
                    "id" => $img->id,
                    "file_name" => $img->file_name,
                    "imagen" => env("APP_URL")."storage/".$img->imagen,
                    "size" => $img->size,
                    "type" => $img->type,
                ];
            }),

            /*   "categorie_id" => $this->resource->categorie_id,
            "categorie" => [
                "id" => $this->resource->categorie->id,
                "icono" => $this->resource->categorie->icono,
                "name" => $this->resource->categorie->name,
            ],
            "categorie_name"=>$this->resource->categorie->name,
            "slug" => $this->resource->slug,
            "sku" => $this->resource->sku,
            "tags" => $this->resource->tags,
            "tags_a" => $this->resource->tags ? explode(",",$this->resource->tags) : [],
            "price_soles" => $this->resource->price_soles,
            "price_usd" => $this->resource->price_usd,
            "resumen" => $this->resource->resumen,
            "description" => $this->resource->description,
            "state" => $this->resource->state,
            "imagen" => env("APP_URL")."storage/".$this->resource->imagen,
            "stock" => $this->resource->stock,
            "proveedor_id"=> $this->resource->proveedor_id,
            "precioCompra"=> $this->resource->precioCompra,
            "fecha_compra"=> $this->resource->fechaCompra,
            "checked_inventario" => $this->resource->type_inventario,
            "images" => $this->resource->images->map(function($img){
                return [
                    "id" => $img->id,
                    "file_name" => $img->file_name,
                    "imagen" => env("APP_URL")."storage/".$img->imagen,
                    "size" => $img->size,
                    "type" => $img->type,
                ];
            }),

            "sizes" => $this->resource->sizes->map(function($size){
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
            // "product_inventaries" =>
        ];
    }
}
