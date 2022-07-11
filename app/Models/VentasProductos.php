<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class VentasProductos extends Model
{
    protected $table = 'venta_producto';

    protected $primaryKey = 'id_venta_producto';

    public $timestamps=false;

    protected $fillable = [
        'id_venta',
        'id_producto',
        'nombre_producto',
        'cantidad_producto',
        'precio_producto',
        'subtotal_producto',
    ];

    protected $guarded = [

    ];
}
