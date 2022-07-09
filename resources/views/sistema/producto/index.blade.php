@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<h3>Listado de Productos <a href="producto/create"><button class="btn btn-success">Nuevo</button></a></h3>
			@include('sistema.producto.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<!-- <th>Id</th> -->
						<th>Código</th>
						<th>Título | Descripción</th>
						<th>Precio (Bs)</th>
						<th>Foto Producto</th>
						<th>Existencia (Stock)</th>
						<th>Opciones</th>
					</thead>

					@foreach ($productos as $prod)
						<tr>
							<!-- <td>{{ $prod->codproducto }}</td> -->
							<td>{{ $prod->codigo }}</td>
							<td>{{ $prod->descripcion }}</td>
							<td>{{ $prod->precio }}</td>
							<td>
								@if($prod->img_producto != '')

								@php
									$url = Storage::url('app/public/'.$prod->img_producto);
								@endphp

									<img src="{{asset($prod->img_producto)}}" alt="{{$prod->descripcion}}" height="100px" width="100px" class="img-thumbnail">
								@else
									<img src="{{asset('imagenes/productos/no_disponible.png')}}" alt="{{$prod->descripcion}}" height="100px" width="100px" class="img-thumbnail">
								@endif
							</td>
							<td>{{ $prod->existencia }}</td>
							<td>
								<a href="{{ action('App\Http\Controllers\ProductoController@edit', $prod->codproducto) }}"><button class="btn btn-info">Editar</button></a>
								<a href="" data-target="#modal-delete-{{$prod->codproducto}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
							</td>
						</tr>
						@include('sistema.producto.modal')
					@endforeach
				</table>
			</div>

			{{ $productos->render() }}
		</div>
	</div>
@endsection
