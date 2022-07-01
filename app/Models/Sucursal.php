<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    protected $table = 'sucursal';

    protected $primaryKey = 'id';

    public $timestamps=false;

    protected $fillable = [
        'nombre',
        'telefono',
        'email',
        'direccion'
    ];

    protected $guarded = [
        
    ];
}
