<?php

namespace App\Models\Proveedor;

use App\Models\Product\Product;
use App\Models\Producto\Producto;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proveedore extends Model
{
    protected $fillable = [
        "nTipoPersona",
        "nTipoDocumento",
        "cNroDocumento",
        "cRazonSocial",
        "cCelular",
        "cCorreo",
        "cPaginaWeb",
        "cDireccion",
        "cActividadPrincipal",
        "cObservaciones",
        "nEstado",
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


    public function contactos()
    {
        return $this->hasMany(ProveedoresContacto::class, 'proveedor_id')->where('nEstado', '<>', 0);
    }

    public function productos()
    {
        return $this->hasMany(Producto::class, 'proveedor_id')->where('nEstado', '<>', 0);
        /* ->where(function ($query) {
                $query->where('state', 1)
                    ->orWhere('state', 2);
            }); */
    }
}
