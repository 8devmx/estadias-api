<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Vacancie extends Model implements AuthenticatableContract, AuthorizableContract
{
    protected $table = 'vacancies'; // función que asegura que lumen este utilizando la tabla con el nombre que se le indica y este es de nuestra tabla en la base de datos

    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state', 'category', 'title', 'company_id', 'description', 'type', 'requirements', 'salary'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password',
    // ];
    // se comento la parte hidden por que desconozco si sea necesario ocultar algún campo, hay que preguntar
}