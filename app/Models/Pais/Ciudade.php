<?php

namespace App\Models\Pais;

use Illuminate\Database\Eloquent\Model;

class Ciudade extends Model
{
    protected $fillable = [
        "id",
        "nombre_ciudad",
        "pais_id",
        "estado",
    ];
}
