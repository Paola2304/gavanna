<?php $this->load->helper('perfil'); ?>

<div class="jumbotron jumbotron-fluid bg-light"><div class="container"></div></div>


<script type="text/javascript">
	$(document).ready(function(){
		if (<?= $this->session->userdata('logueado'); ?> >0) {
			$('#formularios').hide();
			$('#perfilInterfaz').show();
		}
	});
</script>


<div class="container" id="formularios">
	<div class="row" style="margin: auto; width: 45%">
		<!--tITULARES DE FORMULARIOS-->
		<div class="col-12">
			<h1>Inicia <span class="badge badge-warning">sesión <i class="fas fa-user-circle"></i></span></h1>
		</div>
		<!--Formulario de inicio de sesión-->
		<div id="Inicio" class="col-12 card">
			<form id="formInicio" action="<?= base_url('perfil_controller/acceder'); ?>" method="POST">
				<table class="table">
					<tr>
						<td><input class="form-control" type="text" name="correoi" id="correoi" placeholder="Ingresar correo">
							<!--Alerta correo-->
							<div id="mensajeAlerta"></div>
							<!--Alerta fin-->
						</td>
					</tr>
					<tr>
						<td><input style="width: 90%; float: left" class="form-control" type="password" name="passi" id="passi" placeholder="Ingresar tu contraseña">
							<div id="showPassIni" data="0" style="width: 10%;float: left; justify-content: center; cursor: pointer;" class="input-group-text">
								<i style="font-size: 25px;" class="fas fa-eye"></i></div>
							</td>
						</td>
					</tr>
				</table>
			</form>
			<button style="width: 100%; font-size: 20px; font-weight: bold" class="btn btn-primary" id="btnIngresar">Ingresar</button><br>
			<center><a style="text-decoration: none" data-toggle="modal" data-target="#RecoveryPass" href="#"><h5>¿Olvidaste tu contraseña?</h5></a></center>
			<center><a style="text-decoration: none" data-toggle="modal" data-target="#RegistrarseModal" href="#"><h5>¿No tienes cuenta? <span class="badge badge-warning">Registrate <i class="fas fa-feather"></i></span></h5></a></center>
		</div><!--FIN Formulario de inicio de sesión-->
	</div>



	
</div>

<!--Modal recuperacion de contraseña-->
<div class="modal fade" id="RecoveryPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLongTitle">Recuperación de <span class="badge badge-info"> contraseña <i class="fas fa-pen-square"></i></span></h4>
			</div>
			<div class="modal-body">
				<div class="card" style="padding-bottom: 15px; padding-top: 15px">
					<form id="formRecoveryPass" method="POST" action="<?= base_url('perfil_controller/send'); ?>">
						<center><table>
							<tr>
								<td>
									<input class="form-control" type="text" name="RecoveryCorreo" id="RecoveryCorreo" placeholder="Ingresa tu correo">
									<!--Alerta correo-->
									<div id="mensajeAlertaRecovery"></div>
									<!--Alerta fin-->
									<div class="btn btn-info"><b><i class="fas fa-envelope-open-text"></i> Sigue las indicaciones que se enviaran a tu correo.</b></div>
								</td>
							</tr>
						</table>
					</center>
				</form>
			</div>
		</div>
		<div class="modal-footer">
			<button style="width: 50%; font-size: 20px; font-weight: bold" id="btnRecovery" type="button" class="btn btn-primary">Recuperar cuenta</button>
			<button style="width: 50%; font-size: 20px; font-weight: bold" id="cerrarRecovery" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		</div>
	</div>
</div>
</div>
<!--Modal recuperacion de contraseña-->

<!--Modal Registrarse-->
<div class="modal fade" id="RegistrarseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title" id="exampleModalLongTitle"><span class="badge badge-info">Registrarse <i class="fas fa-feather"></i></span></h1>
			</div>
			<div class="modal-body">

				<!--Formulario de Registro-->
				<div class="row" style="float: right; width: 100%; margin: auto; ">
					<div id="Registro" class="col-12 card">
						<form id="formRegistrarse" action="<?= base_url('perfil_controller/registrarse'); ?>" method="POST">
							<table class="table">
								<tr>
									<td><input class="form-control" type="text" name="nombreR" id="nombreR" placeholder="Ingresar tu nombre"></td>
								</tr>
								<tr>
									<td><input class="form-control" type="text" name="apellidoR" id="apellidoR" placeholder="Ingresar tu apellido"></td>
								</tr>
								<tr>
									<td><input class="form-control" type="text" name="correoR" id="correoR" placeholder="Ingresar correo">
										<!--Alerta correo-->
										<div id="mensajeAlertaCorreo"></div>
										<!--Alerta fin-->
									</td>
								</tr>
								<tr>
									<td><input style="float: left; width: 90%" class="form-control" type="password" name="passR" id="passR" placeholder="Ingresar tu contraseña">
										<div id="showPass" data="0" style="width: 10%;float: left; justify-content: center; cursor: pointer;" class="input-group-text">
											<i style="font-size: 25px;" class="fas fa-eye"></i></div>
										</td>
									</tr>
									<tr>
										<td>
											<!--Alerta correo-->
											<div id="mensajeAlertaPass"></div>
											<!--Alerta fin-->
										</td>
									</tr>
								</table>
							</form>
						</div><!-- FIN 	Formulario de registro-->
					</div>

				</div>
				<div class="modal-footer">
					<button style="width: 50%; font-size: 20px; font-weight: bold" class="btn btn-success" id="btnRegistrar">Registrarse</button>
					<button style="width: 50%; font-size: 20px; font-weight: bold" id="cerrarRegistrar" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!--fin Modal Registrarse-->

	<!--Modal cambiar contraseña-->
	<div class="modal fade" id="cambiarPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="exampleModalLongTitle">Cambio de <span class="badge badge-info"> contraseña <i class="fas fa-pen-square"></i></span></h3>
					<div title="Mostrar contraseñas" id="showPassCp" data="0" style="width: 10%;float: left; justify-content: center; cursor: pointer;" class="input-group-text">
												<i style="font-size: 25px;" class="fas fa-eye"></i></div>
				</div>
				<div class="modal-body">
					<div class="card">
						<div style="padding-bottom: 15px; padding-top: 15px">
							<form id="formCpass" method="POST" action="<?= base_url('perfil_controller/change'); ?>">
								<center><table class="table">
									<tr>
										<td>
											<input class="form-control" type="password" name="pass1" id="pass1" placeholder="Ingresa tu contraseña actual">
										</td>
									</tr>
									<tr>
										<td>
											<input class="form-control" type="password" name="pass2" id="pass2" placeholder="Confirma tu contraseña actual">
											<!--Alerta correo-->
											<div id="mensajeAlertaChangePass"></div>
											<!--Alerta fin-->
										</td>
									</tr>
									<tr>
										<td><input class="form-control" type="password" name="passCp" id="passCp" placeholder="Ingresar tu nueva contraseña">
											</td>
										</tr>
									</table>
									<!--Alerta correo-->
												<div id="mensajeAlertaPassCp"></div>
												<!--Alerta fin-->
								</center>
							</form>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button style="width: 50%; font-size: 20px; font-weight: bold" id="btnCpass" type="button" class="btn btn-primary">Cambiar contraseña</button>
					<button style="width: 50%; font-size: 20px; font-weight: bold" id="cerrarCp" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
	<!--Modal cambiar contraseña-->



	<div id="perfilInterfaz"  class="container">
		<div class="row">
			<div class="col-6">
				<h1>Bienvenido <span class="badge badge-warning"><?= $this->session->userdata('nombre'); ?> <i class="far fa-smile-beam"></i></span></h1>
			</div>
			<div class="col-6">
				<div class="btn-group btn-group-toggle" data-toggle="buttons" style="float: right;">
					<button data-toggle="modal" data-target="#cambiarPass" class="btn btn-primary active" id="cambiarPass">
						Cambiar contraseña
					</button>
					<button class="btn btn-danger" id="cerrar">
						Cerrar sesión
					</button>
				</div>
			</div>

		</div>


	</div>