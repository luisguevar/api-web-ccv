<?php


namespace App\Models\Cotizacion;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Cotizacione extends Model
{
    protected $fillable = [
        "cliente_id",
        "vendedor_id",
        "fechaEmision",
        "fechaExpiracion",
        "total",
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

    //cotización pertenece a un usuario
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    //cotización pertenece a un vendedor
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
