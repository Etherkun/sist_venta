<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuario';

    protected $primaryKey = "idusuario";

    public $timestamps=false;

    protected $fillable = [
        'nombre',
        'correo',
        'usuario',
        'clave'
    ];

    protected $guarded = [

    ];
}
