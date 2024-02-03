<?php

namespace App\Models\Pais;

use Illuminate\Database\Eloquent\Model;

class Paise extends Model
{
    protected $fillable = [
        "id",
        "nombre_pais",
        "estado",
    ];
}
