<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VendidoProducto;

class GraficasController extends Controller
{
    public function index(){
        
        $productos = VendidoProducto::all();

        $puntos1 =[];
        foreach($productos as $producto){
            $puntos1[] = ['name' => $producto['nombre_producto'], 'y' => floatval($producto['porcentaje_venta'])];
        }

        return view("sistema.grafico.index", ["data" => json_encode($puntos1)]);
    }
}
