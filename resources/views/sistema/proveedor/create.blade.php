@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Proveedor</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::open(array('url'=>'sistema/proveedor', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{Form::token()}}
			
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre del proveedor ...">
				</div>

				<div class="form-group">
					<label for="nombre">RIF</label>
					<input type="text" name="rif_proveedor" class="form-control" placeholder="RIF ...">
				</div>

				<div class="form-group">
					<label for="nombre">Dirección</label>
					<input type="text" name="direccion" class="form-control" placeholder="Direccion ...">
				</div>

				<div class="form-group">
					<label for="nombre">Descripción</label>
					<input type="text" name="descripcion" class="form-control" placeholder="Descripción ...">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
				</div>

			{!! Form::close() !!}
		</div>
	</div>

<!-- Sección de Jquery -->
@push('scripts')
<script>

function soloLetras(e){
	key = e.keyCode || e.which;
	tecla = String.fromCharCode(key).toLowerCase();
	letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
	especiales = [8,37,39,46];

	tecla_especial = false

	for(var i in especiales){
     	if(key == especiales[i]){
  			tecla_especial = true;
  			break;
        } 
 	}
 
    if(letras.indexOf(tecla)==-1 && !tecla_especial)
 		return false;
 }

</script>

@endpush

<!-- Fin de sección de Jquery -->

@endsection