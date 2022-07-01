@extends ('layouts.admin')
@section ('contenido')
	<!-- Datos del Cliente -->
	<div class="row">
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
			<h3><b>Datos del Cliente</b></h3>
			<div class="form-group">
				<b>Nombre: </b>{{$ventas->nombre_cliente}}<br>
				<b>Cédula / Rif: </b>{{$ventas->cedula_rif_cliente}}<br>
				<b>Teléfono: </b>{{$ventas->telefono_cliente}}<br>
				<b>Dirección: </b>{{$ventas->direccion_cliente}}
			</div>
		</div>

		<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
			<h3><b>Datos de la Sucursal</b></h3>
			<div class="form-group">
				<b>Sucursal: </b>{{$ventas->nombre_sucursal}}<br>
				<b>Teléfono: </b>{{$ventas->telefono_sucursal}}<br>
				<b>Email: </b>{{$ventas->email_sucursal}}<br>
				<b>Dirección: </b>{{$ventas->direccion_sucursal}}
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
		<!-- 	<div class="form-group">
				<h3><b>Datos del Proveedor</b></h3>
				<div class="form-group">
				<b>Proveedor: </b>{{$ventas->nombre_proveedor}}<br>
				<b>Rif: </b>{{$ventas->rif_proveedor}}<br>
				<b>Dirección: </b>{{$ventas->direccion_proveedor}}<br>
			</div> -->
		</div>
	</div>

	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color: #A9D0F5;">
					<th>Productos</th>
					<th>Cantidad</th>
					<th>Precio Unit (Bs)</th>
					<th>Sub-Total (Bs)</th>
				</thead>

				<tbody>
				@foreach($detalle_ventas as $dv)
					<tr>
						<td>{{$dv->nombre_producto}}</td>
						<td>{{$dv->cantidad_producto}}</td>
						<td>{{$dv->precio_producto}}</td>
						<td>{{$dv->subtotal_producto}}</td>
					</tr>
				@endforeach
				</tbody>

				<tfoot>
					<th></th>
					<th></th>
					<th>Total (Bs)</th>
					<th><h4 id="total"> {{$ventas->total}}</h4></th>
					<th></th>
				</tfoot>
			</table>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-4">
		</div>
		<div class="col-lg-3 col-sm-3 col-md-3 col-xs-3">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">


				<a href="{{ action('App\Http\Controllers\VentaController@imprimir_ne_pdf', $id_oculto) }}" id="btn_aprobar" type="button" class="btn btn-primary">Imprimir PDF</a>
			</div>
		</div>
	</div>

@endsection
