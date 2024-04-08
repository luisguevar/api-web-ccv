<?php

namespace App;

use App\Models\Client\AddressUser;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Cotizacion\Cotizacione;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'type_user', 'state', 'role_id', 'email', 'password', 'avatar', 'birthday',
        'gender', 'phone',

        'cNombres',
        'cApellidos',
        'cDocumento',
        'cAvatar',
        'cCelular',
        'dFechaNacimiento',
        'nGenero',
        'nTipoUsuario',
        'nRol',
        'nEstado',
    ];

    public function setPasswordAttribute($password)
    {
        if ($password) {
            $this->attributes["password"] = bcrypt($password);
        }
    }
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function address()
    {
        return $this->hasMany(AddressUser::class);
    }
    public function scopefilterAdvance($query, $state, $search)
    {
        if ($state) {
            $query->where("state", $state);
        }
        if ($search) {
            $query->where("name", "like", "%" . $search . "%")->orWhere("surname", "like", "%" . $search . "%");
        }
        return $query;
    }

    //un usuario puede tener muchas cotizaciones.
    public function cotizacionesClientes()
    {
        return $this->hasMany(Cotizacione::class, 'cliente_id');
    }

    //un usuario puede tener muchas cotizaciones.
    public function cotizacionesUsuarios()
    {
        return $this->hasMany(Cotizacione::class, 'vendedor_id');
    }
}
