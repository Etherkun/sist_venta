@extends ('layouts.admin')
@section ('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Sucursal: {{ $producto->nombre }}</h3>

			@if(count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!! Form::model($producto, ['method'=>'PATCH','route'=>['sistema.producto.update',$producto->codproducto], 'files'=>'true']) !!}
			{{Form::token()}}
			<div class="form-group">
				<label for="nombre">Código</label>
				<input type="text" name="codigo" class="form-control" value="{{ $producto->codigo }}" placeholder="Código del producto ...">
			</div>

			<div class="form-group">
				<label for="nombre">Sucursales</label>
				<select name="id_sucursal" class="form-control">
				@foreach($sucursales as $sucur)
					@if(($sucur->id) == ($producto->id_sucursal))
						<option value="{{$sucur->id}}" selected>{{$sucur->nombre}}</option>
					@else
						<option value="{{$sucur->id}}">{{$sucur->nombre}}</option>
					@endif
				@endforeach
				</select>
			</div>

			<div class="form-group">
				<label for="nombre">Descripción</label>
				<input type="text" name="descripcion" class="form-control" value="{{ $producto->descripcion }}" placeholder="Descripción / Título del producto...">
			</div>

			<div class="form-group">
				<label for="nombre">Precio Unitario (Bs)</label>
				<input type="text" name="precio" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ $producto->precio }}" placeholder="Precio unitario ...">
			</div>

			<div class="form-group">
				<label for="nombre">Existencia (Stock)</label>
				<input type="file" name="img_producto" class="form-control">
				@if(($producto->img_producto) != '')
					<img src="{{asset($producto->img_producto)}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" height="100px" width="100px" class="img-thumbnail">
				@endif
			</div>

			<div class="form-group">
				<label for="nombre">Existencia (Stock)</label>
				<input type="numeric" name="existencia" class="form-control" value="{{ $producto->existencia }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="Existencia en Stock ...">
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
