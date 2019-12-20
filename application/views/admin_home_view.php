<?php $this->load->helper('admin_home'); ?>
<div class="container"><br>
	<div style="float: right;" class="col-8">
					<table class="table table-dark table-hover">
						<thead>
							<tr>
								<td></td>
								<td>Producto</td>
								<td>Especificaciones</td>
								<td>Cantidades vendidas</td>
								<td>Monto vendido</td>
							</tr>
						</thead>
						<tbody id="tablaPopulares"></tbody>
					</table>
				</div>
	<div class="row">
		<div class="col-5">
			<h1 style="height: 100%"><span class="badge badge-info"><i class="fas fa-info"></i>nforme de productos</span></h1></div>
		</div>
		<br>
		<div class="row">
			<!--Encabezado-->
				<div class="col-2">
					<div class="col-sm"><h6><span class="badge badge-warning tituloVineta">Fecha Inicio</span></h6></div>
					<div class="col-sm"><input class="form-control inp" type="date" name="fecheIni" id="fecheIni"></div>
				</div>
				<div class="col-2">
					<div class="col-sm"><h6><span class="badge badge-warning tituloVineta">Fecha Fin</span></h6></div>
					<div class="col-sm"><input class="form-control inp" type="date" name="fecheFin" id="fecheFin"></div>
				</div>
				<!--FIN Encabezado-->
		</div>
		<div style="margin-top: 5px" class="row">
			<div class="col-4">
					<div class="col-sm"><h6><span class="badge badge-warning tituloVineta">Producto</span></h6></div>
					<div class="col-sm"><select class="form-control inp" name="vendido" id="vendido">
						<option value="">----</option>
						<option value="1">Más vendido</option>
						<option value="2">Menos vendido</option>
					</select></div>
				</div>
		</div>
		<div class="row">
				
		</div>
	</div>
</div>


