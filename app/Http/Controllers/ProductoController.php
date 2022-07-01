<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoFormRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Bitacora;
use Carbon\Carbon;
use Redirect;
use File;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
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
            $productos=DB::table('producto')->where('descripcion','LIKE','%'.$query.'%')->orwhere('codigo','LIKE','%'.$query.'%')->orderBy('codproducto','asc')->paginate(5);

            return view('sistema.producto.index',["productos"=>$productos,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $consulta = DB::table('sucursal')
        ->select('id','nombre')
        ->get();

        return view('sistema.producto.create',["sucursales"=>$consulta]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductoFormRequest $request)
    {
        $producto = new Productos;
        $producto->codigo = $request->get('codigo');
        $producto->id_sucursal = $request->get('id_sucursal');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        $producto->existencia = $request->get('existencia');

        if($request->has('img_producto')){
            $file=$request->file('img_producto')->store('public/imagenes');

            $url = Storage::url($file);

            $producto->img_producto = $url;
        }

        $producto->save();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." creó un nuevo registro del producto ".$request->get('codigo')." - ".$request->get('descripcion').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/producto');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("sistema.producto.show",["producto"=>Productos::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consulta = DB::table('sucursal')
        ->select('id','nombre')
        ->get();

        return view("sistema.producto.edit",["producto"=>Productos::findOrFail($id), "sucursales" => $consulta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(ProductoFormRequest $request, $id)
    {
        $producto = Productos::findOrFail($id);
        $producto->codigo = $request->get('codigo');
        $producto->id_sucursal = $request->get('id_sucursal');
        $producto->descripcion = $request->get('descripcion');
        $producto->precio = $request->get('precio');
        $producto->existencia = $request->get('existencia');

        if($request->has('img_producto')){

            $file=$request->file('img_producto')->store('public/imagenes');

            $url = Storage::url($file);

            $producto->img_producto = $url;
        }

        $producto->update();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." modificó el registro del producto ".$request->get('codigo')." - ".$request->get('descripcion').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/producto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto=Productos::findOrFail($id);
        $codigo = $producto->codigo;
        $descripcion = $producto->descripcion;
        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." eliminó el registro del producto ".$codigo." - ".$descripcion.", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        $producto->delete();

        return Redirect::to('sistema/producto');
    }
}
