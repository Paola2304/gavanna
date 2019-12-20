
<?php $this->load->helper('admin_producto'); ?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<div >
				<h1>Producto <span class="badge badge-secondary"><i class="fas fa-tshirt"></i></span></h1>		</div>	
			</div>
			<div class="col-10">
				<!--Respetar la estructura de la tabla para que funcion el dataTable, id de la tabla debe ser 'tabla'-->
				<table class="table table-dark table-hover">
					<thead >
						<tr>
							<td><label>Id</label></td>
							<td><label>Nombre Producto</label></td>
							<td><label>Precio</label></td>
							<td><label>Descripción</label></td>
							<td><label>Categoria</label></td>
						</tr>
					</thead>
					<tbody id="tabla_producto">

					</tbody>
				</table>
			</div>
			<div class="col-2">
				<button type="button" class="btn btn-success" id="nuePro" style="width: 100%; margin-bottom: 5px"><i class="fas fa-plus-square"></i>&nbspNuevo</button>
				<button id="reload" class="btn btn-primary" style="float: right;width: 100%"><i class="fas fa-redo-alt"></i>&nbspRestablecer vista tabla</button>
				<input id="buscar" name="palabra" class="form-control inp" placeholder="Buscar" style="float: right; margin-top: 5px">
			</div>
		</div>
	</div>


	<!-- Modal ELIMINAR principal-->
	<div class="modal" tabindex="-1" role="dialog" id="modalBorrar" data-keyboard="false" data-backdrop="static" data-keyboard="false" data-backdrop="static">
		<!--data-keyboard="false" data-backdrop="static" sirven para bloquear el modal cuando clickeen afuera de el-->
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Confirmación de Eliminación!!!</h5>

				</div>
				<div class="modal-body">
					<p>¿Esta seguro de eliminar este archivo?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" id="btnBorrar">Sí, borrar</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
				</div>
			</div>
		</div>
	</div><!-- Modal ELIMINAR fin-->

	<!-- MODAL INGRESAR Y ACTUALIZAR principal -->
	<div class="modal fade" id="producto" data-keyboard="false" data-backdrop="static"><!--Cambiar el id por su tabla-->
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title" style=" color: #a8834c;"></h4>

				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<form id="formProducto" action="" method="POST" style="color: #46281e;" onsubmit=" return validar() == true" action="off">|


						<table style="width: 80%; margin:auto; ">
							<tr>
								<td><label>Nombre Producto</label></td>
								<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="nombre" id="nombre" autocomplete="off"></td>
							</tr>
							<tr>
								<td><label>Precio</label></td>
								<td><input type="number" step="0.01" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="precio" id="precio"></td>
							</tr>
							<tr>
								<td><label>Descripción</label></td>
								<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="descripcion" id="descripcion"></td>
							</tr>
							<tr>
								<td><label>Categoria</label></td>
								<td><select name="categoria" id="categoria" class="form-control inp">
									<option value="">-- Seleccione una opción--</option>
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

	<!-- Modal 	imagen-tabla-->
	<div class="modal  bd-example-modal-lg" tabindex="-1" role="dialog" id="modalGaleria" data-keyboard="false" data-backdrop="static" data-keyboard="false" data-backdrop="static">
		<!--data-keyboard="false" data-backdrop="static" sirven para bloquear el modal cuando clickeen afuera de el-->
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header">

				</div>
				<div class="modal-body">
					<form id="formCategoria" action="" method="POST" style="color: #46281e;" enctype="multipart/form-data"><!-- Colocar el id del formulario  -->
						<input type="hidden" name="productoI" id="productoI" value="0"><!-- id  -->

						<table style="width: 80%; margin:auto; ">
							<tr>
								<td><label>Imagen</label></td>
								<td>
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text">Subir</span>
										</div>
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="file" name="file">
											<label class="custom-file-label" for="inputGroupFile01 ">Elige un archivo de imagen</label>
										</div>
									</div>
								</td>
								<td><button type="submit" id="btnGuardarIma" class="btn btn-primary">Guardar</button></td>
							</tr>
							<tr>
								<td colspan="2"><div id="imgPortada"></div></td>
							</tr>
						</table><br>
						<table class="table table-dark table-hover">
							<thead >
								<tr>
									<td><label>Id</label></td>
									<td><label>Imagen</label></td>
								</tr>
							</thead>
							<tbody id="tabla_imagen">

							</tbody>
						</table>


					</div>
					<div class="modal-footer">
						<button type="button" id="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</div>
				</form>
			</div>
		</div>
			</div><!-- Modal ELIMINAR fin-->