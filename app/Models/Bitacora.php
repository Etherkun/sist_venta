<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Bitacora extends Model
{
    use HasFactory;
    protected $table='usuario_bitacora';

    protected $primaryKey='id_bitacora';

    public $timestamps=false;

    protected $fillable = [
        'id_usuario',
        'nombre_usuario',
        'email_usuario',
        'bitacora',
        'fecha_bitacora'
    ];

    protected $guarded = [

    ];
}
