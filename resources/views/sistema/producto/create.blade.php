@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Producto</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::open(array('url'=>'sistema/producto', 'method'=>'POST', 'autocomplete'=>'off', 'files' =>'true')) !!}
			{{Form::token()}}

				<div class="form-group">
					<label for="nombre">Código</label>
					<input type="text" name="codigo" class="form-control" placeholder="Código del producto ...">
				</div>

				<div class="form-group">
					<label for="nombre">Sucursales</label>
					<select name="id_sucursal" class="form-control">
					@foreach($sucursales as $sucur)
						<option value="{{$sucur->id}}">{{$sucur->nombre}}</option>
					@endforeach
					</select>
				</div>

				<div class="form-group">
					<label for="nombre">Descripción</label>
					<input type="text" name="descripcion" class="form-control" placeholder="Descripción / Título del producto ...">
				</div>

				<div class="form-group">
					<label for="nombre">Precio unitario (Bs)</label>
					<input type="text" name="precio" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Precio unitario ...">
				</div>

				<div class="form-group">
					<label for="nombre">Imagen del producto</label>
					<input type="file" name="img_producto" class="form-control">
				</div>

				<div class="form-group">
					<label for="nombre">Existencia (Stock)</label>
					<input type="number" name="existencia" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" placeholder="Existencia en Stock ...">
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
