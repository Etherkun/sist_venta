<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    protected $table = 'ventas';

    protected $primaryKey = 'id';

    public $timestamps=false;

    protected $fillable = [
        'id_usuario',
        'id_cliente',
        'id_sucursal',
        'id_proveedor',
        'total',
        'fecha'
    ];

    protected $guarded = [
        
    ];
}
