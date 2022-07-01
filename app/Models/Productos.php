<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    protected $table = 'producto';

    protected $primaryKey = 'codproducto';

    public $timestamps=false;

    protected $fillable = [
        'codigo',
        'id_sucursal',
        'descripcion',
        'precio',
        'existencia',
        'img_producto',
        'usuario_id'
    ];

    protected $guarded = [
        
    ];
}
