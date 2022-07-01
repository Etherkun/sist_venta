<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Bitacora;
use Carbon\Carbon;
use Redirect;
use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        if($request){
            $query=trim($request->get('searchText'));
            $usuarios=DB::table('users')
            ->where('name','LIKE','%'.$query.'%')
            ->orwhere('email','LIKE','%'.$query.'%')
            ->orderBy('id','desc')
            ->paginate(7);

            return view('sistema.usuario.index',["usuarios"=>$usuarios,'searchText'=>$query]);
        }        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('sistema.usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserFormRequest $request)
    {
        
        $usuario = new User;
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->save();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." creó un nuevo registro del usuario ".$request->get('name')." Email: ".$request->get('email').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/usuario');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bitacora = DB::table('usuario_bitacora')
        ->select('nombre_usuario','email_usuario','bitacora')
        ->where('id_usuario','=',$id)
        ->orderBy('fecha_bitacora','desc')
        ->get();

        $usuario = DB::table('users')
        ->select('name','email')
        ->where('id','=',$id)
        ->first();

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
        return view("sistema.usuario.show",["bitacora"=>$bitacora,"usuario"=>$usuario]);
    }

    public function edit($id)
    {
        return view("sistema.usuario.edit",["usuario"=>User::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */
    public function update(UserFormRequest $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->update();

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." modificó el registro del usuario ".$request->get('name')." Email: ".$request->get('email').", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        return Redirect::to('sistema/usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ventas  $ventas
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);
        $usuario_name = $usuario->name;
        $usuario_email = $usuario->email;

        $tiempo = Carbon::now('America/Caracas');

        $bitacora= new Bitacora;
        $bitacora->id_usuario = auth()->user()->id;
        $bitacora->nombre_usuario = auth()->user()->name;
        $bitacora->email_usuario = auth()->user()->email;
        $bitacora->bitacora = "* ".auth()->user()->name." eliminó el registro del usuario ".$usuario_name." Email: ".$usuario_email.", en fecha: ".$tiempo->toDateTimeString();
        $bitacora->fecha_bitacora = $tiempo->toDateTimeString();
        $bitacora->save();

        $usuario->delete();

        return Redirect::to('sistema/usuario');
    }   
}

