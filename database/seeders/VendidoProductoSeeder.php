<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VendidoProducto;
use Illuminate\Support\Facades\DB;

class VendidoProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Sql de productos
        $productos = DB::table('producto')
        ->select('codproducto','descripcion')
        ->where('existencia','>',0)
        ->get();

        $total_productos = DB::table('venta_producto')
        ->select(DB::raw('SUM(cantidad_producto) as total_productos'))
        ->first();

        $cont = 0; $data = [];

        while($cont < count($productos)){

            $venta_productos = DB::table('venta_producto')
            ->select(DB::raw('SUM(cantidad_producto) as total_cantidad_producto'))
            ->where('id_producto','=',$productos[$cont]->codproducto)
            ->first();
            
            $calculo = (($venta_productos->total_cantidad_producto / $total_productos->total_productos) * 100);
            $porcentaje = number_format($calculo,2);

            $data[] = array('id_producto' => $productos->codproducto,'nombre_producto' => $productos[$cont]->descripcion, 'porcentaje_venta' => $porcentaje);

            $cont++;

        }

        VendidoProducto::insert($data);
        
    }
}
