@extends ('layouts.admin')
@section ('contenido')
	<!-- Datos del Cliente -->
	<div class="row">
		<div class="col-lg-2 col-sm-2 col-md-2 col-xs-2">
		</div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-6">
			<h3><b>Datos del Usuario</b></h3>
			<div class="form-group">
				<b>Nombre: </b>{{$usuario->name}}<br>
				<b>Email: </b>{{$usuario->email}}
			</div>
		</div>

	<div class="row">
		<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
			<table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
				<thead style="background-color: #A9D0F5;">
					<th>Bitacora</th>
				</thead>
				
				<tbody>
				@foreach($bitacora as $bita)
					<tr>
						<td>{{$bita->bitacora}}</td>
					</tr>
				@endforeach
				</tbody>
			</table>
		</div>
	</div>

@endsection