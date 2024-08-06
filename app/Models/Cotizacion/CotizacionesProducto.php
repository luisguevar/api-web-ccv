<?php

namespace App\Models\Cotizacion;

use App\Models\Producto\Producto;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class CotizacionesProducto extends Model
{
    protected $table = 'cotizacion_productos';

    protected $fillable = [
        "cotizacion_id",
        "producto_id",
        "nCantidad",
        "nPrecioUnitario",
        "nDescuento",
        "nEstado",
        "cUsuarioCreacion",
        "cUsuarioModificacion",
    ];

    public function product()
    {
        return $this->belongsTo(Producto::class, 'producto_id');
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
