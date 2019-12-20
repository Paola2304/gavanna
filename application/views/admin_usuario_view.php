<?php $this->load->helper('admin_usuario'); //Incluimos nuestro helper ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div >
				<h1>Usuario <span class="badge badge-secondary"><i class="fas fa-users"></i></span></h1>
			</div>
		</div>
		<div class="col-10">
			<!--Respetar la estructura de la tabla para que funcion el dataTable, id de la tabla debe ser 'tabla'-->
			<table class="table table-dark table-hover">
				<thead >
					<tr>
						<td><label>Id</label></td>
						<td><label>Nombre completo</label></td>
						<td><label>Correo</label></td>
						<td><label>Rol</label></td>
					</tr>
				</thead>
				<tbody id="tabla_usuario">

				</tbody>
			</table>
		</div><!--Contenedor col-10-->
		<div class="col-2">
			<!--Boton Nuevo-->
			<button type="button" class="btn btn-success" id="nueUsu" style="width: 100%; margin-bottom: 5px"><i class="fas fa-plus-square"></i>&nbspNuevo</button>
			<!--Boton restaurar vista-->
			<button id="reload" class="btn btn-primary" style="float: right;width: 100%"><i class="fas fa-redo-alt"></i>&nbspRestablecer vista tabla</button>
			<!--Buscador-->
			<input id="buscar" name="palabra" class="form-control inp" placeholder="Buscar" style="float: right; margin-top: 5px">
		</div>

	</div><!--Contenedor fila-->
</div><!--Contenedor grande container-fluid-->


<!-- Modal ELIMINAR-->
<div class="modal" tabindex="-1" role="dialog" id="modalBorrar" data-keyboard="false" data-backdrop="static" >
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
<div class="modal fade" id="usuario" data-keyboard="false" data-backdrop="static"><!--Cambiar el id por su tabla-->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" style=" color: #a8834c;"></h4>

			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="formUsuario" action="" method="POST" style="color: #46281e;"><!-- Colocar el id del formulario  -->
					<input type="hidden" name="id_usuario" id="id" value="0"><!-- id  -->

					<table style="width: 80%; margin:auto; ">
						<tr>
							<td><label>Nombres</label></td>
							<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="nombre" id="nombre"></td>
						</tr>
						<tr>
							<td><label>Apellidos</label></td>
							<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="apellido" id="apellido"></td>
						</tr>
						<tr>
							<td><label>Correo <i style="cursor: pointer" title="Formato correcto nombre@example.com" class="fas fa-info-circle text-info"></i></label></td>
							<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="correo" id="correo">
								<!--Alerta correo-->
								<div id="mensajeAlerta"></div>
								<!--Alerta fin-->
							</td>
						</tr>
						<tr>
							<td><label>Rol</label></td>
							<td><select name="rol" id="rol" class="form-control inp">
								<option value="">-- Seleccione una opción--</option>
							</select></td>
						</tr>
						<tr id="rowPass" >
							<td><label>Contraseña</label></td>
							<td><input style="width: 90%; float: left;" type="password" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="pass" id="pass"> 
								<div id="showPass" data="0" style="width: 10%;float: left; justify-content: center; cursor: pointer;" class="input-group-text">
									<i style="font-size: 25px;" class="fas fa-eye"></i></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<!--Alerta pass-->
									<div id="mensajeAlertaPass"></div>
									<!--Alerta fin-->
								</td>
							</tr>
						</table>						
					</div>
				</form>
				<!-- Modal footer -->
				<div class="modal-footer">
					<button type="button" id="btnGuardar" class="btn btn-primary">Guardar</button>
					<button type="button" id="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>

				</div>
			</div>
		</div>
	</div>	
