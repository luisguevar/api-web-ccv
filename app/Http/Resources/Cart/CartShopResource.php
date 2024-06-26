<?php

namespace App\Http\Resources\Cart;

use Illuminate\Http\Resources\Json\JsonResource;

class CartShopResource extends JsonResource
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
            "id" => $this->resource->id,
            "user_id" => $this->resource->user_id,
            "user" => [
                "id" => $this->resource->client->id,
                "name" =>$this->resource->client->name,
            ],
            "product_id" => $this->resource->product_id,
            "product" => [
                "id" =>  $this->resource->product->id,
                "title" => $this->resource->product->cDescripcion,
                "slug" => $this->resource->product->cSlug,
                "price_soles" => $this->resource->product->nPrecioPEN,
                "price_usd" => $this->resource->product->nPrecioUSD,
                "imagen" =>  env("APP_URL")."storage/".$this->resource->product->cImagen,
            ],
            "type_discount" => $this->resource->type_discount,
            "discount" => $this->resource->discount,
            "cantidad" => $this->resource->cantidad,
            "product_size_id" => $this->resource->product_size_id,
          /*   "product_size" => $this->resource->product_size ? [
                "id" => $this->resource->product_size->id,
                "name" => $this->resource->product_size->name
            ] : NULL, */
            /* "product_color_size_id" => $this->resource->product_color_size_id,
            "product_color_size" => $this->resource->product_color_size ? [
                "id" => $this->resource->product_color_size->id,
                "name" => $this->resource->product_color_size->product_color->name
            ] : NULL, */
            "code_cupon" => $this->resource->code_cupon,
            "code_discount" => $this->resource->code_discount,
            "precio_unitario" => $this->resource->precio_unitario,
            "subtotal" => $this->resource->subtotal,
            "total" => $this->resource->total,
        ];
    }
}
