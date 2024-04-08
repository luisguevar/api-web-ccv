<?php

namespace App\Models\Producto;

use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;
use App\Models\Product\Product;
use App\Models\Discount\DiscountCategorie;

class Categoria extends Model
{
    protected $fillable = [
        "cDescripcion",
        "cImagen",
        "cIcono",
        "nEstado",
        "cUsuarioCreacion",
        "cUsuarioModificacion"
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'categorie_id');
    }

    public function discountcategories()
    {
        return $this->hasMany(DiscountCategorie::class, 'categorie_id');
    }


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
}
