<?php

namespace App\Models\Proveedor;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Proveedore extends Model
{
    protected $fillable = [
        "razon_social"
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
