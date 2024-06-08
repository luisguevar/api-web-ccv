<?php

namespace App\Models\Cliente;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cliente extends Model
{
    protected $fillable = [
        "cNombres",
        "cApellidos",
        "cCorreo",
        "nTipoPersona",
        "nTipoDocumento",
        "cNroDocumento",
        "cCelular",
        "nEstado",
        'cDireccion',
        'pais_id',
        'ciudad_id',
        "cUsuarioCreacion",
        "cUsuarioModificacion",
        "usuario_id"

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
