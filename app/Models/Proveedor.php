<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;
class Proveedor extends Model
{
    protected $table = 'proveedor';

    protected $primaryKey = 'id_proveedor';

    public $timestamps=false;

    protected $fillable = [
        'nombre',
        'rif_proveedor',
        'direccion',
        'descripcion'
    ];

    protected $guarded = [

    ];
}
