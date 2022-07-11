<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Cliente extends Model
{
    protected $table='cliente';

    protected $primaryKey='idcliente';

    public $timestamps=false;

    protected $fillable = [
        'nombre',
        'cedula_rif',
        'telefono',
        'direccion'
    ];

    protected $guarded = [

    ];
}
