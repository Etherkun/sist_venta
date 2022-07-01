@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Sucursal</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::open(array('url'=>'sistema/sucursal', 'method'=>'POST', 'autocomplete'=>'off')) !!}
			{{Form::token()}}

				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" name="nombre" class="form-control" placeholder="Nombre del proveedor ...">
				</div>

				<div class="form-group">
					<label for="nombre">Teléfono</label>
					<input type="text" name="telefono" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Telefono ...">
				</div>

				<div class="form-group">
					<label for="nombre">Email</label>
					<input type="text" name="email" class="form-control" placeholder="Email ...">
				</div>

				<div class="form-group">
					<label for="nombre">Dirección</label>
					<input type="text" name="direccion" class="form-control" placeholder="Dirección ...">
				</div>

				<div class="form-group">
					<button class="btn btn-primary" type="submit">Guardar</button>
					<button class="btn btn-danger" type="reset">Cancelar</button>
                    <button class="btn btn-warning" type="return">Cancelar</button>
				</div>

			{!! Form::close() !!}
		</div>
	</div>

@endsection
