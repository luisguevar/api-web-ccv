<?php


namespace App\Models\Cotizacion;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use App\Models\Cliente\Cliente;

class Cotizacione extends Model
{
    protected $fillable = [
        'id',
        'cliente_id',
        'vendedor_id',
        'dFechaEmision',  
        'dFechaExpiracion',  
        'nTotal',  
        'cObservaciones',  
        'nValorDescuento',

        'nEstado',
        'cUsuarioCreacion',
        'cUsuarioModificacion',
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
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    //cotización pertenece a un vendedor
    public function vendedor()
    {
        return $this->belongsTo(User::class, 'vendedor_id');
    }
}
