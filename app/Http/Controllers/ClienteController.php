<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ClienteFormRequest;
use App\Models\Cliente;
use App\Models\Bitacora;
use Carbon\Carbon;
use Redirect;
use Illuminate\Support\Facades\DB;


class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $clientes=DB::table('cliente')->where('nombre','LIKE','%'.$query.'%')->orwhere('cedula_rif','LIKE','%'.$query.'%')->where('estado','=','0')->orderBy('idcliente','asc')->paginate(7);


            return view('sistema.cliente.index',["clientes"=>$clientes,"searchText"=>$query]);
        }
    }

    public function create()
    {
        return view('sistema.cliente.create');
    }

    public function store(ClienteFormRequest $request)
    {
        $request->validate([
            'cedula_rif'=>'required|unique:cliente|max:11'
        ]);


        $cliente = new Cliente;
        $cliente->nombre = $request->get('nombre');
        $cliente->cedula_rif = $request->get('cedula_rif');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');
        $cliente->estado = '1';
        $cliente->save();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = $request->get('id_usuario_activo');
        $bitacora->nombre_usuario = $request->get('nombre_usuario_activo');
        $bitacora->email_usuario = $request->get('email_usuario_activo');
        $bitacora->bitacora = "* ".$request->get('nombre_usuario_activo')." creó un nuevo registro del cliente ".$request->get('nombre').", Cédula / Rif: ".$request->get('cedula_rif')." en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/cliente');

    }

    public function show($id)
    {
        return view("sistema.cliente.show",["cliente"=>Cliente::findOrFail($id)]);
    }

    public function edit($id)
    {
        return view("sistema.cliente.edit",["cliente"=>Cliente::findOrFail($id)]);
    }

    public function update(ClienteFormRequest $request, $id)
    {
        $cliente=Cliente::findOrFail($id);
        $cliente->nombre = $request->get('nombre');
        $cliente->cedula_rif = $request->get('cedula_rif');
        $cliente->telefono = $request->get('telefono');
        $cliente->direccion = $request->get('direccion');
        $cliente->update();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = $request->get('id_usuario_activo');
        $bitacora->nombre_usuario = $request->get('nombre_usuario_activo');
        $bitacora->email_usuario = $request->get('email_usuario_activo');
        $bitacora->bitacora = "* ".$request->get('nombre_usuario_activo')." modificó el registro del cliente ".$request->get('nombre').", Cédula / Rif: ".$request->get('cedula_rif')." en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/cliente');
    }

    public function destroy($id)
    {
        $cliente=Cliente::findOrFail($id);
        $nombre_cliente = $cliente->nombre;
        $cedula_rif_cliente = $cliente->cedula_rif;

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." eliminó el registro del cliente ".$nombre_cliente.", Cédula / Rif: ".$cedula_rif_cliente." en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        $cliente->estado = '0';
        $cliente->delete();

        return Redirect::to('sistema/cliente');
    }
}
