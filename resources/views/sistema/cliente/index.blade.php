@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Clientes <a href="cliente/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('sistema.cliente.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Cedula / Rif</th>
						<th>Teléfono</th>
						<th>Dirección</th>
						<th>Opciones</th>
					</thead>

					@foreach ($clientes as $cli)
						<tr>
							<td>{{ $cli->idcliente }}</td>
							<td>{{ $cli->nombre }}</td>
							<td>{{ $cli->cedula_rif }}</td>
							<td>{{ $cli->telefono }}</td>
							<td>{{ $cli->direccion }}</td>
							<td>
								<a href="{{ action('App\Http\Controllers\ClienteController@edit', $cli->idcliente) }}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$cli->idcliente}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('sistema.cliente.modal')
					@endforeach
				</table>
			</div>

			{{ $clientes->render() }}
		</div>
	</div>
@endsection