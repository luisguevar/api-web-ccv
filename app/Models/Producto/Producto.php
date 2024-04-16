<?php

namespace App\Models\Producto;

use App\Models\Product\ProductImage;
use App\Models\Producto\Categoria;
use App\Models\Sale\Review\Review;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Producto extends Model
{

    protected $fillable = [
        "cDescripcion",
        "categoria_id",
        "proveedor_id",
        "cSlug",
        "cSku",
        "nPrecioPEN",
        "nPrecioUSD",
        "cResumen",
        "cDescripcionDetallada",
        "nEstado",
        "cImagen",
        "nStock",
        "nPrecioCompra",
        "dFechaCompra",
        "cUsuarioCreacion",
        "cUsuarioModificacion"

    ];
    public function setCreatedAtAttribute($value)
    {
        date_default_timezone_set("America/Lima");
        $this->attributes["created_at"] = Carbon::now();
    }

    public function setUpdatedAtAttribute($value)
    {
        date_default_timezone_set("America/Lima");
        $this->attributes["updated_at"] = Carbon::now();
    }

    public function categorie()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }


    public function getAvgRatingAttribute()
    {
        return $this->reviews->avg("rating");
    }

    protected $withCount = ['reviews'];

    public function scopefilterAdvance($query, $categories, $review, $min_price, $max_price, $size_id, $color_id, $search_product)
    {
        if ($categories && sizeof($categories) > 0) {
            $query->whereIn("categoria_id", $categories);
        }
        if ($review) {
            $query->whereHas("reviews", function ($q) use ($review) {
                $q->where("rating", $review);
            });
        }
        if ($min_price > 0 && $max_price > 0) {
            error_log($min_price);
            error_log($max_price);
            $query->whereBetween("nPrecioPEN", [$min_price, $max_price]);
        }
       /*  if ($size_id) {
            $query->whereHas("sizes", function ($q) use ($size_id) {
                $q->where("name", "like", "%" . $size_id . "%");
            });
        }
        if ($color_id) {
            $query->whereHas("sizes", function ($q) use ($color_id) {
                $q->whereHas("product_size_colors", function ($qt) use ($color_id) {
                    $qt->where("product_color_id", $color_id);
                });
            });
        } */
        if ($search_product) {
            $query->where("title", "like", "%" . $search_product . "%");
        }
        return $query;
    }
}
