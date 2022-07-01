<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img align="center" src="../public/imagenes/logo_empresa_final.jpg" width="300" height="100">

	<div class="container" style="font-size: 12px;">
		<div class="row" align="center">
			<p><b>MULTISERVICIOS PACE |</b>
			<b>RIF: V-07391115-6</b></p>
		</div>

		<div class="row" align="center">
			<b>Dirección:</b> Calle 16 entre Av. Fuerzas Armadas y Carrera 11 Qta. Esmeralda N° 10-67 Barquisimeto - Lara
			<p><b>Telfs.:</b> (0414) 507.98.35 - (0416) 709.02.50 </p>
			<p><b>Email:</b> agathapace@hotmail.com</p>

		</div>

		<div class="row">

			<div class="col" style="float: left; width: 25%; margin-left: 0%;">
				<h5><b>Cliente</b></h5>
				<b>Nombre: </b>{{$ventas->nombre_cliente}}<br>
				<b>Cédula / Rif: </b>{{$ventas->cedula_rif_cliente}}<br>
				<b>Teléfono: </b>{{$ventas->telefono_cliente}}<br>
				<b>Dirección: </b>{{$ventas->direccion_cliente}}
			</div>

			<div class="col" style="float: left; width: 25%; margin-left: 12%;">
				<h5><b>Sucursal</b></h5>
				<b>Sucursal: </b>{{$ventas->nombre_sucursal}}<br>
				<b>Teléfono: </b>{{$ventas->telefono_sucursal}}<br>
				<b>Email: </b>{{$ventas->email_sucursal}}<br>
				<b>Dirección: </b>{{$ventas->direccion_sucursal}}
			</div>

<!-- 			<div class="col" style="float: left; width: 25%; margin-left: 10%;">
				<h5><b>Proveedor</b></h5>
				<b>Proveedor: </b>{{$ventas->nombre_proveedor}}<br>
				<b>Rif: </b>{{$ventas->rif_proveedor}}<br>
				<b>Dirección: </b>{{$ventas->direccion_proveedor}}
			</div> -->
		</div>
	</div>

	<div class="row" style="font-size: 12px; margin-top: 25%;" align="center">
	<!--DATOS SENCILLOS DEL PAGO-->
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">Productos</th>
					<th scope="col">Cantidad</th>
					<th scope="col">Precio Unit. (Bs)</th>
					<th scope="col">Sub-Total (Bs)</th>
				</tr>
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
				<th>{{$ventas->total}}</th>
				<th></th>
			</tfoot>
		</table>
	</div>



