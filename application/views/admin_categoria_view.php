<?php $this->load->helper('admin_categoria'); //Incluimos nuestro helper ?>
<div class="container-fluid"><br>
	<div class="row">
		<div class="col-12">
			<div >
				<h1>Categoria <span class="badge badge-secondary"><i class="fas fa-tags"></i></span></h1>
			</div>
		</div>
		<div class="col-10">
			<!--Respetar la estructura de la tabla para que funcion el dataTable, id de la tabla debe ser 'tabla'-->
			<table id="example2" class="table table-dark table-hover">
				<thead >
					<tr>
						<td><label>Id</label></td>
						<td><label>Categoria</label></td>
						<td><label>Portada</label></td>
					</tr>
				</thead>
				<tbody id="tabla_categoria">

				</tbody>
			</table>
		</div><!--Contenedor col-10-->
		<div class="col-2">
			<!--Boton Nuevo-->
			<button type="button" class="btn btn-success" id="nueCat" style="width: 100%; margin-bottom: 5px"><i class="fas fa-plus-square"></i>&nbspNuevo</button>
			<!--Boton restaurar vista-->
			<button id="reload" class="btn btn-primary" style="float: right;width: 100%"><i class="fas fa-redo-alt"></i>&nbspRestablecer vista tabla</button>
			<!--Buscador-->
			<input id="buscar" name="palabra" class="form-control inp" placeholder="Buscar" style="float: right; margin-top: 5px">
		</div>

	</div><!--Contenedor fila-->
</div><!--Contenedor grande container-fluid-->

<!-- Modal Image-->
<div class="modal" tabindex="-1" role="dialog" id="modalImage" data-keyboard="false" data-backdrop="static" data-keyboard="false" data-backdrop="static">
	<!--data-keyboard="false" data-backdrop="static" sirven para bloquear el modal cuando clickeen afuera de el-->
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-body">
				<div id="imagen"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div><!-- Modal ELIMINAR fin-->

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
<div class="modal fade" id="categoria" data-keyboard="false" data-backdrop="static"><!--Cambiar el id por su tabla-->
	<div class="modal-dialog modal-lg">
		<div class="modal-content">

			<!-- Modal Header -->
			<div class="modal-header">
				<h4 class="modal-title" style=" color: #a8834c;"></h4>

			</div>

			<!-- Modal body -->
			<div class="modal-body">
				<form id="formCategoria" action="" method="POST" style="color: #46281e;" enctype="multipart/form-data"><!-- Colocar el id del formulario  -->
					<input type="hidden" name="id_categoria" id="id" value="0"><!-- id  -->

					<table style="width: 80%; margin:auto; ">
						<tr>
							<td><label>Categoria</label></td>
							<td><input type="text" class="form-control inp" aria-label="Small" aria-describedby="inputGroup-sizing-sm" name="categoriaI" id="categoriaI"></td>
						</tr>
						<tr>
							<td><label>Portada</label></td>
							<td>
								<div class="input-group mb-3">
									<div class="input-group-prepend">
										<span class="input-group-text"><i id="iconoFile" class="fas fa-file-upload text-secondary"></i></span>
									</div>
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="file" name="file">
										<label class="custom-file-label" for="inputGroupFile01">Elige un archivo de imagen</label>
									</div></div>
								</td>
							</tr>
							<tr>
								<td></td>
								<td>
									<div id="mensajeAlerta"></div>
								</td>
							</tr>
							<tr>
								<td colspan="2"><div id="imgPortada"></div></td>
							</tr>
						</table>						
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="submit" id="btnGuardar" class="btn btn-primary">Guardar</button>
						<button type="button" id="cerrar" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
					</form>	
				</div>
			</div>
		</div>
	</div>	