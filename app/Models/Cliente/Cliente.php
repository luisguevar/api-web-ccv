<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cliente extends Model
{
    protected $fillable = [
        "nombres",
        "apellidos",
        "correo",
        "nroDocumento",
        "estado",
        "contacto",
        "tipoPersona",
        "pais",
        "departamento",
        "direccion",
        "observacion"
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
