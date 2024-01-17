<?php

namespace App\Models\Cotizacion;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class CotizacionesProducto extends Model
{
    protected $table = 'detalle_cotizaciones';

    protected $fillable = [
        "cotizacion_id",
        "producto_id",
        "cantidad",
        "precio",
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
}
