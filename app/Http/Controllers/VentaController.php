<?php

namespace App\Http\Controllers;

use App\Models\Ventas;
use App\Models\VentasProductos;
use Illuminate\Http\Request;
use App\Http\Requests\VentaFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Bitacora;
use PDF;
use Redirect;
use File;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $ventas=DB::table('ventas as v')
            ->join('users as u','v.id_usuario','=','u.id')
            ->join('cliente as c','v.id_cliente','=','c.idcliente')
            ->join('proveedor as p','v.id_proveedor','=','p.id_proveedor')
            ->select('v.id as id_venta','u.name as nombre_usuario','c.nombre as nombre_cliente','p.nombre as nombre_proveedor','v.total as total','v.fecha as fecha')
            ->where('u.name','LIKE','%'.$query.'%')
            ->orwhere('c.nombre','LIKE','%'.$query.'%')
            ->orwhere('p.nombre','LIKE','%'.$query.'%')
            ->orderBy('v.id','desc')
            ->groupBy('id_venta','nombre_usuario','nombre_cliente','nombre_proveedor','total','fecha')
            ->paginate(7);

            $clientes=DB::table('cliente')
            ->select('idcliente','nombre','cedula_rif')
            ->get();

            $sucursales=DB::table('sucursal')
            ->select('id','nombre')
            ->get();

            return view('sistema.venta.index',["ventas"=>$ventas,"clientes"=>$clientes,'sucursales'=>$sucursales,'searchText'=>$query]);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $id_cliente = $request->get('id_cliente');
        $id_sucursal = $request->get('id_sucursal');

        $clientes=DB::table('cliente')
        ->select('nombre','cedula_rif','telefono','direccion')
        ->where('idcliente','=',$id_cliente)
        ->first();

        $sucursales=DB::table('sucursal')
        ->select('nombre','telefono','email','direccion')
        ->where('id','=',$id_sucursal)
        ->first();

        $proveedores=DB::table('proveedor')
        ->select('id_proveedor','nombre','rif_proveedor')
        ->get();

        $productos=DB::table('producto')
        ->select('codproducto','codigo','descripcion','precio','img_producto','existencia')
        ->where('id_sucursal','=',$id_sucursal)
        ->where('existencia','>',0)
        ->get();

        return view('sistema.venta.create',["sucursales"=>$sucursales,"clientes"=>$clientes,"proveedores"=>$proveedores,"id_cliente_oculto"=>$id_cliente,"id_sucursal_oculto"=>$id_sucursal,"productos"=>$productos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VentaFormRequest $request)
    {
        try{
            DB::beginTransaction();

            $tiempo = Carbon::now('America/Caracas');

            //errores

            // $archivo=fopen("../errores/nombres_productos.txt", "w+");
            // fwrite($archivo, $request->get('nombre_producto'));            

            $venta = new Ventas;
            $venta->id_usuario = auth()->user()->id;
            $venta->id_cliente = $request->get('id_cliente_oculto');
            $venta->id_sucursal = $request->get('id_sucursal_oculto');
            $venta->id_proveedor = $request->get('id_proveedor');
            $venta->total = $request->get('total_valor');
            $venta->fecha = $tiempo->toDateTimeString();
            $venta->save();

            $idmax = Ventas::max('id');

            $cont=0;

            //Datos recibidos de la tabla dinamica
            $id_producto = $request->get('productos');
            $nombre_producto = $request->get('nombre_producto');
            $cantidad_producto = $request->get('cantidad_producto');
            $precio_producto = $request->get('precio_producto');

            while($cont < count($id_producto)){
                
                $venta_producto = new VentasProductos;
                $venta_producto->id_venta = $idmax;
                $venta_producto->id_producto = $id_producto[$cont];
                $venta_producto->nombre_producto = $nombre_producto[$cont];
                $venta_producto->cantidad_producto = $cantidad_producto[$cont];
                $venta_producto->precio_producto = $precio_producto[$cont];
                $venta_producto->subtotal_producto = $cantidad_producto[$cont] * $precio_producto[$cont];
                $venta_producto->save();

                $cont++;
            }

            //Decrementar la existencia en cada producto en la tabla "producto"
            //Recorrer la tabla "venta_producto" para obtener las cantidades
            //de los productos qué deben restablecerse en la tabla "producto"

            $query_producto = DB::table('venta_producto')
                ->select('id_producto','cantidad_producto')
                ->where('id_venta','=',$idmax)
                ->get();

                $cont_producto = 0;

                while($cont_producto < count($query_producto)){

                    $actualizar_producto = DB::table('producto')
                    ->where('codproducto','=',$query_producto[$cont_producto]->id_producto);
                    
                    $actualizar_producto->decrement('existencia',$query_producto[$cont_producto]->cantidad_producto);

                    $cont_producto++;
                }

            $bitacora= new Bitacora;
            $bitacora->id_usuario = auth()->user()->id;
            $bitacora->nombre_usuario = auth()->user()->name;
            $bitacora->email_usuario = auth()->user()->email;
            $bitacora->bitacora = "* ".auth()->user()->name." creó un nuevo registro venta con el ID: ".$idmax.", en fecha: ".$tiempo->toDateTimeString();
            $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
            $bitacora->save();

            DB::commit();

        }catch(\Exception $ex)
        {
            dd($ex->getMessage());

            $archivo=fopen("../errores/error_ruta_agregar.txt", "w+");
            fwrite($archivo, $ex);

            DB::rollback();
        }

        return Redirect::to('sistema/venta');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ventas=DB::table('ventas as v')
        ->join('users as u','v.id_usuario','=','u.id')
        ->join('cliente as c','v.id_cliente','=','c.idcliente')
        ->join('sucursal as s','v.id_sucursal','=','s.id')
        ->join('proveedor as p','v.id_proveedor','=','p.id_proveedor')
        ->select('u.name as nombre_usuario','c.nombre as nombre_cliente','c.cedula_rif as cedula_rif_cliente','c.telefono as telefono_cliente','c.direccion as direccion_cliente','s.nombre as nombre_sucursal','s.telefono as telefono_sucursal','s.email as email_sucursal','s.direccion as direccion_sucursal','p.nombre as nombre_proveedor','p.rif_proveedor as rif_proveedor','p.direccion as direccion_proveedor','v.total as total','v.fecha as fecha')
        ->where('v.id','=',$id)
        ->groupBy('nombre_usuario','nombre_cliente','cedula_rif_cliente','telefono_cliente','direccion_cliente','nombre_sucursal','telefono_sucursal','email_sucursal','direccion_sucursal','nombre_proveedor','rif_proveedor','direccion_proveedor','total','fecha')
        ->first();

        $detalle_ventas=DB::table('venta_producto')
        ->select('nombre_producto','cantidad_producto','precio_producto','subtotal_producto')
        ->where('id_venta','=',$id)
        ->get();

        return view("sistema.venta.show",["id_oculto"=>$id,"ventas"=>$ventas,"detalle_ventas"=>$detalle_ventas]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function edit(Ventas $ventas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ventas $ventas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */

    //Función que imprime PDF de la Nota de Entrega
    public function imprimir_ne_pdf($id){
            
        $ventas=DB::table('ventas as v')
        ->join('users as u','v.id_usuario','=','u.id')
        ->join('cliente as c','v.id_cliente','=','c.idcliente')
        ->join('sucursal as s','v.id_sucursal','=','s.id')
        ->join('proveedor as p','v.id_proveedor','=','p.id_proveedor')
        ->select('u.name as nombre_usuario','c.nombre as nombre_cliente','c.cedula_rif as cedula_rif_cliente','c.telefono as telefono_cliente','c.direccion as direccion_cliente','s.nombre as nombre_sucursal','s.telefono as telefono_sucursal','s.email as email_sucursal','s.direccion as direccion_sucursal','p.nombre as nombre_proveedor','p.rif_proveedor as rif_proveedor','p.direccion as direccion_proveedor','v.total as total','v.fecha as fecha')
        ->where('v.id','=',$id)
        ->groupBy('nombre_usuario','nombre_cliente','cedula_rif_cliente','telefono_cliente','direccion_cliente','nombre_sucursal','telefono_sucursal','email_sucursal','direccion_sucursal','nombre_proveedor','rif_proveedor','direccion_proveedor','total','fecha')
        ->first();

        $detalle_ventas=DB::table('venta_producto')
        ->select('nombre_producto','cantidad_producto','precio_producto','subtotal_producto')
        ->where('id_venta','=',$id)
        ->get();
        
        $pdf = PDF::loadview('sistema.venta.imprimir', ['id_venta'=>$id,'ventas'=>$ventas,'detalle_ventas'=>$detalle_ventas]);
        

        $nombre_archivo = "nota_entrega_".$id.".pdf";

        return $pdf->download($nombre_archivo);
                
    }








    public function destroy($id)
    {
        //Recorrer la tabla "venta_producto" para obtener las cantidades
        //de los productos qué deben restablecerse en la tabla "producto"
        
        $query_producto = DB::table('venta_producto')
        ->select('id_producto','cantidad_producto')
        ->where('id_venta','=',$id)
        ->get();

        $cont_producto2 = 0;

        while($cont_producto2 < count($query_producto)){

            $actualizar_producto = DB::table('producto')
            ->where('codproducto','=',$query_producto[$cont_producto2]->id_producto)
            ->increment('existencia',$query_producto[$cont_producto2]->cantidad_producto);

            $cont_producto2++;
        }

        //Eliminar registros de los productos en las ventas
        //de la tabla "venta_producto"

        $query_venta_producto = DB::table('venta_producto');
        $query_venta_producto->where('id_venta','=',$id);
        $query_venta_producto->delete();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." eliminó el registro venta con el ID: ".$id.", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        //Eliminar registro de las ventas
        $ventas = Ventas::findOrFail($id);
        $ventas->delete();

        return Redirect::to('sistema/venta');
    }
}
