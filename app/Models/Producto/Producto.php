<?php

namespace App\Models\Producto;

use App\Models\Product\ProductImage;
use App\Models\Producto\Categoria;
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

}
