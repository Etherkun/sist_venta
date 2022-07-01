@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Cliente</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::open(array('url'=>'sistema/cliente', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Nombre(s) y Apellido(s)</label>
				<input type="text" name="nombre" onkeypress="return soloLetras(event)" class="form-control" placeholder="Nombre(s) y Apellido(s) ...">
			</div>

			<div class="form-group">
				<label for="nombre">Cédula / RIF</label>
				<input type="text" name="cedula_rif" class="form-control" placeholder="Cédula / RIF ...">
			</div>

			<div class="form-group">
				<label for="nombre">Teléfono</label>
				<input type="text" name="telefono" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Télefono ...">
			</div>

			<div class="form-group">
				<label for="nombre">Dirección</label>
				<input type="text" name="direccion" class="form-control" placeholder="Direccion ...">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Cancelar</button>
                <button class="btn btn-warning" type="return">Cancelar</button>
			</div>

			<!-- Datos del usuario activo -->
			<input type="hidden" name="id_usuario_activo" value="{{auth()->user()->id}}">
			<input type="hidden" name="nombre_usuario_activo" value="{{auth()->user()->name}}">
			<input type="hidden" name="email_usuario_activo" value="{{auth()->user()->email}}">


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
