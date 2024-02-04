<?php

namespace App\Models\Proveedor;

use App\Models\Product\Product;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proveedore extends Model
{
    protected $fillable = [
        "tipoPersona",
        "tipoDocumento",
        "nroDocumento",
        "razon_social",
        "celular",
        "correo",
        "web",
        "direccion",
        "observaciones",
        "actividad",
        "estado",

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


    public function contactos()
    {
        return $this->hasMany(ProveedoresContacto::class, 'proveedor_id')->where('estado', 1);
    }

    public function productos()
    {
        return $this->hasMany(Product::class, 'proveedor_id')
            ->where(function ($query) {
                $query->where('state', 1)
                    ->orWhere('state', 2);
            });
    }
}
