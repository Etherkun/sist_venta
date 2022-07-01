<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use App\Http\Requests\SucursalFormRequest;
use App\Models\Bitacora;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\DB;

class SucursalController extends Controller
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
            $sucursales=DB::table('sucursal')->where('nombre','LIKE','%'.$query.'%')->orderBy('id','asc')->paginate(7);

            return view('sistema.sucursal.index',["sucursales"=>$sucursales,"searchText"=>$query]);
        }   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.sucursal.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SucursalFormRequest $request)
    {
        $sucursal = new Sucursal;
        $sucursal->nombre = $request->get('nombre');
        $sucursal->telefono = $request->get('telefono');
        $sucursal->email = $request->get('email');
        $sucursal->direccion = $request->get('direccion');
        $sucursal->save();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." creó un nuevo registro de la sucursal ".$request->get('nombre').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/sucursal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view("sistema.sucursal.show",["sucursal"=>Sucursal::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view("sistema.sucursal.edit",["sucursal"=>Sucursal::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function update(SucursalFormRequest $request, $id)
    {
        $sucursal = Sucursal::findOrFail($id);
        $sucursal->nombre = $request->get('nombre');
        $sucursal->telefono = $request->get('telefono');
        $sucursal->email = $request->get('email');
        $sucursal->direccion = $request->get('direccion');
        $sucursal->update();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." modificó el registro de la sucursal ".$request->get('nombre').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/sucursal');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sucursal  $sucursal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sucursal=Sucursal::findOrFail($id);
        $sucursal_nombre = $sucursal->nombre;
        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." eliminó el registro de la sucursal ".$sucursal_nombre.", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        $sucursal->delete();

        return Redirect::to('sistema/sucursal');   
    }
}
