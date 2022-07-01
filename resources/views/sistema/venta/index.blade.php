@extends ('layouts.admin')
@section ('contenido')

	<div class="row">
			<h3>Registros de Venta</h3>

			{!!Form::open(array('url'=>'sistema/venta/create','method'=>'GET','autocomplete'=>'off'))!!}
			{{Form::token()}}

			<!-- Opcion de Despacho  -->
				<div id="superior">
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
						<div class="form-group">
							<label for="id_cliente">Clientes</label>
							<select name="id_cliente" class="form-control selectpicker" data-live-search="true">
								@foreach($clientes as $cli)
									<option value="{{$cli->idcliente}}">{{$cli->nombre}} | {{$cli->cedula_rif}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
						<div class="form-group">
							<label for="id_sucursal">Sucursales</label>
							<select name="id_sucursal" class="form-control selectpicker" data-live-search="true">
								@foreach($sucursales as $suc)
									<option value="{{$suc->id}}">{{$suc->nombre}}</option>
								@endforeach
							</select>
						</div>
					</div>

					<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
						<div class="form-group">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<span class="input-group-btn">
								<a href="venta/create" title="Crear registro de venta"><button type="submit" class="btn btn-success">Nuevo</button></a>
							</span>
						</div>
					</div>
				</div>

			{!!Form::close()!!}
	<div class="row"></div>
	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			@include('sistema.venta.search')
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Usuario Encargado</th>
						<th>Cliente</th>
						<th>Proveedor</th>
						<th>Fecha Venta</th>
						<th>Total (Bs)</th>
						<th>Opciones</th>
					</thead>

					@foreach ($ventas as $ven)
						<tr>
							<td>{{ $ven->id_venta }}</td>
							<td>{{ $ven->nombre_usuario }}</td>
							<td>{{ $ven->nombre_cliente }}</td>
							<td>{{ $ven->nombre_proveedor }}</td>
							<td>{{ $ven->fecha }}</td>
							<td>{{ $ven->total }}</td>
							<td>
								<a href="{{ action('App\Http\Controllers\VentaController@show', $ven->id_venta) }}"><button class="btn btn-info">Ver</button></a>
								<!-- <a href="" data-target="#modal-delete-{{$ven->id_venta}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a> -->
							</td>
						</tr>
						@include('sistema.venta.modal')
					@endforeach
				</table>
			</div>

			{{ $ventas->render() }}
		</div>
	</div>
@endsection
