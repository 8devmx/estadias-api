<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table = 'estados';

    // Define los campos que puedes llenar
    protected $fillable = ['nombre'];

    // Si tienes campos de tiempo como `created_at` y `updated_at` en tu tabla, 
    // puedes incluir las siguientes líneas:
    // public $timestamps = true;
}
