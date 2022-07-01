<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\ProveedorFormRequest;
use App\Models\Bitacora;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
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
            $proveedor=DB::table('proveedor')->where('nombre','LIKE','%'.$query.'%')->orwhere('rif_proveedor','LIKE','%'.$query.'%')->orderBy('id_proveedor','asc')->paginate(7);

            return view('sistema.proveedor.index',["proveedores"=>$proveedor,"searchText"=>$query]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.proveedor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProveedorFormRequest $request)
    {
        $proveedor = new Proveedor;
        $proveedor->nombre = $request->get('nombre');
        $proveedor->rif_proveedor = $request->get('rif_proveedor');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->descripcion = $request->get('descripcion');
        $proveedor->save();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." creó un nuevo registro del proveedor ".$request->get('nombre').", Rif: ".$request->get('rif_proveedor').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/proveedor');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("sistema.proveedor.show",["proveedor"=>Proveedor::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("sistema.proveedor.edit",["proveedor"=>Proveedor::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorFormRequest $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre = $request->get('nombre');
        $proveedor->rif_proveedor = $request->get('rif_proveedor');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->descripcion = $request->get('descripcion');
        $proveedor->update();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." modificó el registro del proveedor ".$request->get('nombre').", Rif: ".$request->get('rif_proveedor').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/proveedor');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proveedor=Proveedor::findOrFail($id);
        $nombre_prov = $proveedor->nombre;
        $rif = $proveedor->rif_proveedor;
        
        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." eliminó el registro del proveedor ".$nombre_prov.", Rif: ".$rif.", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        $proveedor->delete();

        return Redirect::to('sistema/proveedor');
    }
}
