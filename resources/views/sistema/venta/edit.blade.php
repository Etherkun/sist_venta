@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sucursal: {{ $sucursal->nombre }}</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($sucursal, ['method'=>'PATCH','route'=>['sistema.sucursal.update',$sucursal->id] ]) !!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Nombre</label>
				<input type="text" name="nombre" class="form-control" value="{{ $sucursal->nombre }}" placeholder="Nombre ...">
			</div>

			<div class="form-group">
				<label for="nombre">Teléfono</label>
				<input type="text" name="telefono" class="form-control" value="{{ $sucursal->telefono }}" placeholder="Teléfono ...">
			</div>

			<div class="form-group">
				<label for="nombre">Email</label>
				<input type="text" name="email" class="form-control" value="{{ $sucursal->email }}" placeholder="Email ...">
			</div>

			<div class="form-group">
				<label for="nombre">Dirección</label>
				<input type="text" name="direccion" class="form-control" value="{{ $sucursal->direccion }}" placeholder="Descripción ...">
			</div>

			<div class="form-group">
				<button class="btn btn-primary" type="submit">Guardar</button>
				<button class="btn btn-danger" type="reset">Limpiar</button>
                <button class="btn btn-warning" type="return">Cancelar</button>
			</div>




			{!! Form::close() !!}
		</div>
	</div>

@endsection
