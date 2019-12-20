<?php $this->load->helper('admin_direccion'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div >
				<h1>Direcciones <span class="badge badge-secondary"><i class="fas fa-map-signs"></i></span></h1>
			</div>
		</div>
		<div class="col-10">
			<!--Respetar la estructura de la tabla para que funcion el , id de la tabla debe ser 'tabla'-->
			<table class="table table-dark table-hover">
				<thead >
					<tr>
						<td><label>Id</label></td>
						<td><label>Usuario</label></td>
						<td><label>Departamento</label></td>
						<td><label>Municipio</label></td>
						<td><label>Dirección</label></td>
						<td><label>Teléfono</label></td>
						<td colspan="2"><label>Operaciones</label></td>
					</tr>
				</thead>
				<tbody id="tabla_direccion">

				</tbody>
			</table>
		</div><!--Contenedor col-10-->
		<div class="col-2">
			<!--Boton Nuevo-->
			<button type="button" class="btn btn-success" id="nueDir" style="width: 100%; margin-bottom: 5px"><i class="fas fa-plus-square"></i>&nbspNuevo</button>
			<!--Boton restaurar vista-->
			<button id="reload" class="btn btn-primary" style="float: right;width: 100%"><i class="fas fa-redo-alt"></i>&nbspRestablecer vista tabla</button>
			<!--Buscador-->
			<input id="buscar" name="palabra" class="form-control inp" placeholder="Buscar" style="float: right; margin-top: 5px">
		</div>

	</div><!--Contenedor fila-->
</div><!--Contenedor grande container-fluid-->


<!-- Modal ELIMINAR-->
<div class="modal" tabindex="-1" role="dialog" id="modalBorrar" data-keyboard="false" data-backdrop="static" data-keyboard="false" data-backdrop="static">
	<!--data-keyboard="false" data-backdrop="static" sirven para bloquear el modal cuando clickeen afuera de el-->
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Confirmación de eliminación</h5>

			</div>
			<div class="modal-body">
				<p>¿Esta seguro de eliminar el archivo?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" id="btnBorrar">Sí, borrar</button>
				<button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div><!-- Modal ELIMINAR fin-->

<!-- MODAL INGRESAR Y ACTUALIZAR -->
<div class="modal fade" id="direccion" data-keyboard="false" data-backdrop="static"><!--Cambiar el id por su tabla-->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" style=" color: #a8834c;"></h4>

			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="formDireccion" action="" method="POST" style="color: #46281e;" onsubmit=" return validar() == true" action="off" ><!-- Colocar el id del formulario  -->
					<input type="hidden" name="id_direccion" id="id" value="0"><!-- id  -->

					<table style="width: 80%; margin:auto; ">
						<tr>
							<td><label>Usuario</label></td>
							<input type="hidden" name="nombre" id="nombre" >
							<td><div id="ocusuario">

								<input type="text" name="nombre"  list="usuario" class="form-control" placeholder="Buscar usuario..." id="xx">
								<datalist id="usuario"></datalist>
								</div>
								<div id="ocusuario2">
									<input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="usuario2" disabled="">
								</div>
							</td>
						</tr>

						<tr>
							<td><label>Departamento</label></td>
							<td><select name="departamento" id="departamento" class="form-control inp">
								<option value="">-- Seleccione un departamento--</option>
							</select></td>
						</tr>

						<tr>
							<td><label>Municipio</label></td>
							<td><select name="municipio" id="municipio" class="form-control inp">
								<option value="">-- Seleccione un municipio--</option>
							</select></td>
						</tr>

						<tr>
							<td><label>Direccion</label></td>
							<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="direccion" id="txtdireccion"></td>
						</tr>
						<tr>
							<td><label>Telefono</label></td>
							<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="telefono" id="telefono"></td>
						</tr>
					</table>
				</form>							
			</div>

			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
				<button type="button" id="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>	