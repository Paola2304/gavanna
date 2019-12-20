<?php $this->load->helper('admin_producto_detalle'); //Incluimos nuestro helper ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div >
				<h1>Detalles de producto <span class="badge badge-secondary"><i class="fas fa-tasks"></i></span></h1>
				
			</div>
		</div>
		<div class="col-10">
			<!--Respetar la estructura de la tabla para que funcion el , id de la tabla debe ser 'tabla'-->
			<table class="table table-dark table-hover">
				<thead >
					<tr>
						<td><label>Id</label></td>
						<td><label>Categoria</label></td>
						<td><label>Producto</label></td>
						<td><label>Talla</label></td>
						<td><label>Color</label></td>
						<td><label>Cantidad</label></td>
						<td><label>Operaciones</label></td>

					</tr>
				</thead>
				<tbody id="tabla_productodetalle">

				</tbody>
			</table>
		</div><!--Contenedor col-10-->
		<div class="col-2">
			<!--Boton Nuevo-->
			<button type="button" class="btn btn-success" id="nueDetail" style="width: 100%; margin-bottom: 5px"><i class="fas fa-plus-square"></i>&nbspNuevo</button>
			<!--Boton restaurar vista-->
			<button id="reload" class="btn btn-primary" style="float: right;width: 100%"><i class="fas fa-redo-alt"></i>&nbspRestablecer vista tabla</button>
			<!--Buscador-->
			<input id="buscar" name="palabra" class="form-control inp" placeholder="Buscar" style="float: right; margin-top: 5px">
		</div>

	</div><!--Contenedor fila-->
</div><!--Contenedor grande container-fluid-->


<!-- Modal ELIMINAR-->
<div class="modal" tabindex="-1" role="dialog" id="modalBorrar"  data-keyboard="false" data-backdrop="static">
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
<div class="modal fade" id="detalle" data-keyboard="false" data-backdrop="static"><!--Cambiar el id por su tabla-->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" style=" color: #a8834c;"></h4>

			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="formDetalle" action="" method="POST" style="color: #46281e;" onsubmit="return validarFormulario();" ><!-- Colocar el id del formulario  -->
					<input type="hidden" name="id_producto_detalle" id="id" value="0"><!-- id  -->
					<input type="hidden" name="exist" id="exist" value="0"><!-- existencias -->
					<input type="hidden" name="registro" id="registro" value="0"><!-- registro  -->
					<!-- <input type="hidden" name="act" id="act" value="0"> --><!-- ACTUALIZA -->

					<table style="width: 80%; margin:auto; ">
						<tr>
							<td><label>Categoria</label></td>
							<td><div id="ocS1">
								<select name="categoria" id="categoria" class="form-control" >
									<option value="">-- Seleccione una categoria--</option>
								</select>
							</div>
							<div id="ocI1">
								<input type="text" disabled name="categoria" id="categoria1" class="form-control producto">
							</div>
						</td>
					</tr>
					<tr>
						<td><label>Producto</label></td>
						<td><div id="ocS2">
							<select name="producto" id="producto" class="form-control">
								<option value="">-- Seleccione un producto--</option>
							</select>
						</div>
						<div id="ocI2">
							<input type="text" disabled name="producto" id="producto2" class="form-control producto">
						</div>
					</td>
				</tr>
				<tr>
					<td><label>Talla</label></td>

					<td><div id="ocS3">
						<select name="talla" id="talla" class="form-control">
							<option value="">-- Seleccione una opción--</option>
						</select>
					</div>
					<div id="ocI3">
						<input type="text" disabled name="talla" id="talla3" class="form-control producto">
					</div>
				</td>
			</tr>
			<tr>
				<td><label>Color</label></td>

				<td><div id="ocS4">
					<select name="color" id="color" class="form-control">
						<option value="">-- Seleccione una opción--</option>
					</select>
				</div>
				<div id="ocI4">
					<input type="text" disabled name="color" id="color4" class="form-control producto">
				</div>
			</td>
		</tr>
		<tr>
			<td><label class="vinetaCantidad"></label></td>
			<td><input type="number" class="form-control sm" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="cantidad" id="cantidad" disabled><div id="vinetaInfo"></div></td>
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
