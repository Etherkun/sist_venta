@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Usuarios <a href="usuario/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('sistema.usuario.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<!-- <th>Id</th> -->
						<th>Nombres</th>
						<th>Emails</th>
						<th>Opciones</th>
					</thead>

					@foreach ($usuarios as $usua)
						<tr>
							<!-- <td>{{ $usua->id }}</td> -->
							<td>{{ $usua->name }}</td>
							<td>{{ $usua->email }}</td>
							<td>
                                <a href="{{ action('App\Http\Controllers\UserController@show', $usua->id) }}"><button class="btn btn-primary">Permisos</button></a>
								<a href="{{ action('App\Http\Controllers\UserController@show', $usua->id) }}"><button class="btn btn-warning">Bitacora</button></a>
								<a href="{{ action('App\Http\Controllers\UserController@edit', $usua->id) }}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$usua->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('sistema.usuario.modal')
					@endforeach
				</table>
			</div>

			{{ $usuarios->render() }}
		</div>
	</div>
@endsection
