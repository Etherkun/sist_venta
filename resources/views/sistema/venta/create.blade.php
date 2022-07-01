@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<h3>Nueva Venta</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>	
	</div>
			{!! Form::open(array('url'=>'sistema/venta', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{Form::token()}}
			
				<!-- Datos del Cliente -->
				<div class="row">
					<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
					</div>
					<div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
						<h3><b>Datos del Cliente</b></h3>
						<div class="form-group">
							<b>Nombre: </b>{{$clientes->nombre}}<br>
							<b>Cédula / Rif: </b>{{$clientes->cedula_rif}}<br>
							<b>Teléfono: </b>{{$clientes->telefono}}<br>
							<b>Dirección: </b>{{$clientes->direccion}}
						</div>
					</div>

					<div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
						<h3><b>Datos de la Sucursal</b></h3>
						<div class="form-group">
							<b>Sucursal: </b>{{$sucursales->nombre}}<br>
							<b>Teléfono: </b>{{$sucursales->telefono}}<br>
							<b>Email: </b>{{$sucursales->email}}<br>
							<b>Dirección: </b>{{$sucursales->direccion}}
						</div>
					</div>
				</div>

		
	

	<!-- Valores oculto qué se enviarán en el POST -->
	<input type="hidden" name="id_cliente_oculto" value="{{$id_cliente_oculto}}">
	<input type="hidden" name="id_sucursal_oculto" value="{{$id_sucursal_oculto}}">

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			<div class="form-group">
				<label>Escoja un proveedor</label>
				<select name="id_proveedor" class="form-control selectpicker" data-live-search="true">
					@foreach($proveedores as $prov)
						<option value="{{$prov->id_proveedor}}">{{$prov->nombre}} | {{$prov->rif_proveedor}}</option>
					@endforeach
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

			<!-- Lista de productos ocultos -->
			<input type="hidden" id="productos_ocultos" value="{{$productos}}">

			<div class="form-group">
				<label for="nombre">Seleccione el producto para agregar</label>
				<select id="id_producto" name="id_producto" class="form-control selectpicker" data-live-search="true" onchange="modificar();">
					@php
						$cont=0; $maxima_existencia=0;
					@endphp
					@foreach($productos as $prod)
							
						<option value="{{$prod->codproducto}}">({{$prod->codigo}}) - {{$prod->descripcion}} | Precio Unit (Bs): {{$prod->precio}}</option>
						@php
							if($cont == 0){
								$maxima_existencia = $prod->existencia;
								$cont++;
							}
						@endphp
					@endforeach
				</select>
			</div>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

			<div class="form-group">
				<label for="pcantidad">Cantidad</label>
				<input type="number" class="form-control" id="pcantidad" name="pcantidad" value="" min="1" max="{{$maxima_existencia}}" onkeyup="let max= parseInt(this.max);
        let valor = parseInt(this.value);
    	if((valor>max) || (valor<0)){
    		alert('El Valor no está Permitido')
    		this.value = '';
    	}">
			</div>
		</div>

		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
			<div class="form-group">
				<button type="button" id="btn_agregar" class="btn btn-primary" onclick="agregar();">Agregar</button>
			</div>
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
					<th>Opciones</th>
				</thead>
				
				<tbody>
					
				</tbody>
				
				<tfoot>
					<th></th>
					<th></th>
					<th>Total (Bs)</th>
					<th><h4 id="total"> 0.00</h4></th>
					<th></th>
				</tfoot>
			</table>
		</div>
	</div>
	<input type="hidden" id="total_valor" name="total_valor" value="0">
	<div class="row">
		<div class="col-lg-6 col-md-6 col-md-6 col-xs-6" id="guardar" hidden="true">
			<div class="form-group">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<button class="btn btn-success" type="submit">Guardar</button>
				
			</div>
		</div>
	</div>
	{!! Form::close() !!}

<!-- Sección de Jquery -->
@push('scripts')
<script>

var cont=0;
subtotal=[];
total=0;

function modificar(){
	id_producto_sel = $("#id_producto").val();
	producto_oculto = $("#productos_ocultos").val();
	cadena = $.parseJSON(producto_oculto);

	for(i=0;i<cadena.length;i++){
		if(id_producto_sel == cadena[i].codproducto){
			$("#pcantidad").attr('max',cadena[i].existencia);
		}
	}
}

function verificar(){
	if(total > 0){
		$("#guardar").show();
	}else{
		$("#guardar").hide();
	}
}

function agregar(){
	
	id_producto_sel = $("#id_producto").val();
	producto_oculto = $("#productos_ocultos").val();
	cadena = $.parseJSON(producto_oculto);
	cant = $("#pcantidad").val();

	if(cant > 0){
		for(i=0;i<cadena.length;i++){
			if(id_producto_sel == cadena[i].codproducto){
				
				id_producto = $("#id_producto").val();
				nombre_producto = cadena[i].descripcion;
				cantidad_producto = $("#pcantidad").val();
				precio_producto = cadena[i].precio;
				subtotal[cont] = cantidad_producto * precio_producto;
				total = total + subtotal[cont];

				var fila='<tr class="selected" id="fila'+cont+'"><td><input name="productos[]" type="hidden" value="'+id_producto+'"><input name="nombre_producto[]" type="hidden" value="'+nombre_producto+'">'+nombre_producto+'</td><td><input type="hidden" name="cantidad_producto[]" value="'+cantidad_producto+'">'+cantidad_producto+'</td><td><input type="hidden" name="precio_producto[]" value="'+precio_producto+'">'+precio_producto+'</td><td>'+subtotal[cont]+'</td><td><button type="button" class="btn btn-warning" onclick="eliminar_fila('+cont+');">X</button></td></tr>';

				cont++;
				i = cadena.length;
				$("#detalles").append(fila);
				$("#pcantidad").val("");
				$("#total").html(total);
				$("#total_valor").val(total);
				verificar();
			}
		}
	}else{
		alert('Coloqué una cantidad aceptable, gracias...!!!')
	}
}

function eliminar_fila(index){
	total=total-subtotal[index];
	$("#total").html(total);
	$("#total_valor").val(total);
	$("#fila"+index).remove();
	verificar();
}

</script>

@endpush

<!-- Fin de sección de Jquery -->

@endsection