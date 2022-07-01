@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Sucursales <a href="sucursal/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('sistema.sucursal.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Nombre</th>
						<th>Teléfono</th>
						<th>Email</th>
						<th>Opciones</th>
					</thead>

					@foreach ($sucursales as $suc)
						<tr>
							<td>{{ $suc->id }}</td>
							<td>{{ $suc->nombre }}</td>
							<td>{{ $suc->telefono }}</td>
							<td>{{ $suc->email }}</td>
							<td>
								<a href="{{ action('App\Http\Controllers\SucursalController@edit', $suc->id) }}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$suc->id}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('sistema.sucursal.modal')
					@endforeach
				</table>
			</div>

			{{ $sucursales->render() }}
		</div>
	</div>
@endsection