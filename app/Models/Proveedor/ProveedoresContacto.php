<?php

namespace App\Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class ProveedoresContacto extends Model
{
    protected $fillable = [
        "proveedor_id",
        "cNombreCompleto",
        "cCelular",
        "cCorreo",
        "nTipoDocumento",
        "cNroDocumento",
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
}
