<?php $this->load->helper('admin_pedido'); //Incluimos nuestro helper ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div >
				<h1>Pedidos <span class="badge badge-secondary"><i class="fas fa-box-open"></i></span></h1>
				
			</div>
		</div>
		<div class="col-10">
			<!--Respetar la estructura de la tabla para que funcion el dataTable, id de la tabla debe ser 'tabla'-->
			<table class="table table-dark table-hover">
				<thead >
					<tr>
						<td><label>Id</label></td>
						<td><label>Usuario</label></td>
						<!--<td><label>Apellido</label></td>-->
						<td><label>Fecha</label></td>
						<!-- <td><label>Subtotal</label></td> -->
						<td><label>Cargo envio</label></td>
						<!-- <td><label>Monto total</label></td> -->
						<td><label>Estado</label></td>
						<td><label>Operaciones</label></td>

					</tr>
				</thead>
				<tbody id="tabla_pedido">

				</tbody>
			</table>
		</div><!--Contenedor col-10-->
		<div class="col-2">
			<!--Boton Nuevo-->
			<button type="button" class="btn btn-success" id="nuePed" style="width: 100%; margin-bottom: 5px"><i class="fas fa-plus-square"></i>&nbspNuevo</button>
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
<div class="modal fade" id="pedido" data-keyboard="false" data-backdrop="static"><!--Cambiar el id por su tabla-->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" style=" color: #a8834c;"></h4>

			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="formPedido" action="" method="POST" style="color: #46281e;" onsubmit="return validarFormulario();" ><!-- Colocar el id del formulario  -->
					<input type="hidden" name="id_pedido" id="id" value="0"><!-- id  -->

					<table style="width: 80%; margin:auto; ">
						<tr>
							<td><label>Usuario</label></td>
							<td><select name="usuario" id="usuario" class="form-control inp">
								<option value="">-- Seleccione un usuario--</option>
							</select></td>
						</tr>
						<tr>
							<td><label>Fecha</label></td>
							<td><input type="date" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="fecha" id="fecha" value="<?= $fecha=date('Y-m-d') ?>"></td>
						</tr>
						<!-- <tr>
							<td><label>subtotal</label></td>
							<td><input type="number" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="subtotal" id="subtotal"></td>
						</tr> -->
						<tr>
							<td><label>Cargo envio</label></td>
							<td><input type="number" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="cargo_envio" id="cargo_envio"></td>
						</tr>
						<!-- <tr>
							<td><label>Monto total</label></td>
							<td><input type="number" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="monto_total" id="monto_total"></td>
						</tr> -->
						<tr>
							<td><label>Estado</label></td>
							<td><select name="estado" id="estado" class="form-control inp">
								<option value="">-- Seleccione un estado--</option>
							</select></td>
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
<!-- __________________________________________________________DETALLES____________________________________________________________ -->

<!-- Modal detalles-->
<div class="modal bd-example-modal-lg" tabindex="-1" role="dialog" id="detallesModal" data-keyboard="false" data-backdrop="static" data-keyboard="false" data-backdrop="static">
	<!--data-keyboard="false" data-backdrop="static" sirven para bloquear el modal cuando clickeen afuera de el-->
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Detalles de pedido</h5>

			</div>
			<div class="modal-body">
				<form id="detallesForm" action="<?= base_url('admin_pedido_controller/ingresarDetalle')?>" method="POST">
					<input type="hidden" name="exist" id="exist" value="0">
					<input type="hidden" name="registro" id="registro" value="0">
					<input type="hidden" name="existe" id="existe" value="0">

				</div>


			</form><br>
			<div class="container">
				<table class="table table-dark table-hover" >
					<thead >
						<tr>
							<td><label>Id</label></td>
							<td><label>Nombre</label></td>
							<td><label>Talla</label></td>
							<td><label>Color</label></td>
							<td><label>Cantidad</label></td>


						</tr>
					</thead>
					<tbody id="existencias">

					</tbody>
				</table>
			</div>

			<div id="tablaDetalles">

			</div>





			<!-- Modal footer -->
			<div class="modal-footer">
				<button type="button" id="cerrar2" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>	
