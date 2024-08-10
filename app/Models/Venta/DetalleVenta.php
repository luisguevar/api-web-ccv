<?php

namespace App\Models\Venta;

use Illuminate\Database\Eloquent\Model;
use App\Models\Producto\Producto;

class DetalleVenta extends Model
{
    protected $table = 'detalle_venta';

    protected $fillable = [
        "venta_id",
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
}
