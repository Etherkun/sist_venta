@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Proveedores <a href="proveedor/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('sistema.proveedor.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<!-- <th>Id</th> -->
						<th>Nombre</th>
						<th>Rif</th>
						<th>Dirección</th>
						<th>Opciones</th>
					</thead>

					@foreach ($proveedores as $pro)
						<tr>
							<!-- <td>{{ $pro->id_proveedor }}</td> -->
							<td>{{ $pro->nombre }}</td>
							<td>{{ $pro->rif_proveedor }}</td>
							<td>{{ $pro->direccion }}</td>
							<td>
								<a href="{{ action('App\Http\Controllers\ProveedorController@edit', $pro->id_proveedor) }}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$pro->id_proveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('sistema.proveedor.modal')
					@endforeach
				</table>
			</div>

			{{ $proveedores->render() }}
		</div>
	</div>
@endsection
