<script type="text/javascript">
	
	$(document).ready(function(){

		$('#formularios').show();
		$('#perfilInterfaz').hide();

//Boton btnIngresar Iniciar session
$('#btnIngresar').click(function(){
	$respuesta=validacionesIngresar();
	if ($respuesta==true) {

		$url = $('#formInicio').attr('action');
		$data = $('#formInicio').serialize();
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: $url,
			data: $data,
			dataType: 'json',

			success: function(datos){

				if(datos.id_rol==2){
					location.replace("home_controller");

				}else if(datos.id_rol==1){
					location.replace("admin_home_controller");

				}else{
					alertify.notify('Error al iniciar sesion, verifique su coreo y contraseña!', 'error',10, null);
				}
			}
		});
			}//Fin respuesta IF validacion
		});

//*************************************************************************************
//Boton btnRecovery recuperrar contraseña

$('#btnRecovery').click(function(){
	$respuesta=validacionesRecovery();
	if ($respuesta==true) {
		$url = $('#formRecoveryPass').attr('action');
		$data = $('#formRecoveryPass').serialize();
		$('#RecoveryPass').modal('hide');
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: $url,
			data: $data,
			dataType: 'json',

			success: function(respuesta){

				if (respuesta=='Exito') {
					alertify.notify('Correo de recuperación enviado', 'success',10, null);
				}else{
					alertify.notify('Este correo no esta registrado, por favor contacta con nuestros administradores', 'error',10, null);
				}

				restablecerRecovery();
			}
		});
			}//Fin respuesta IF validacion

		});


$('#cerrarRecovery').click(function(){
	restablecerRecovery();
});

function restablecerRecovery(){
	$('#RecoveryCorreo').css('box-shadow','none');
	$('#RecoveryCorreo').val("");
	$('#RecoveryCorreo').attr("placeholder", "Ingresa tu correo");
	$(".alert").alert('close');
}

//*********************************************************************************************************************
//Boton btnIngresar registrarse
$('#btnRegistrar').click(function(){
	$respuesta=validacionesRegistrarse();
	if ($respuesta==true) {

		$url = $('#formRegistrarse').attr('action');
		$data = $('#formRegistrarse').serialize();
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: $url,
			data: $data,
			dataType: 'json',

			success: function(datos){

				if(datos.id_rol==2){
					location.replace("perfil_controller");

				}else{
					alertify.notify('Error en el procedimiento de registro, contacte a nuestros administradores!', 'error',10, null);
				}
				restablecerRegistrar();
			}
		});
	}

});

$('#cerrarRegistrar').click(function(){
	restablecerRegistrar();
});

function restablecerRegistrar(){
	$('#nombreR').css('box-shadow','none');
	$('#nombreR').val("");
	$('#nombreR').attr("placeholder", "Ingresa tu nombre");
	$('#apellidoR').css('box-shadow','none');
	$('#apellidoR').val("");
	$('#apellidoR').attr("placeholder", "Ingresa tu apellido");
	$('#correoR').css('box-shadow','none');
	$('#correoR').val("");
	$('#correoR').attr("placeholder", "Ingresa tu correo");
	$('#passR').css('box-shadow','none');
	$('#passR').val("");
	$('#passR').attr("placeholder", "Ingresa tu contraseña");
	
	$(".alert").alert('close');
}

//****************************************************************************************************
//mostrar contraseña
$('#showPass').click(function(){
	var vineta='';
	var estado=$('#showPass').attr('data');
	if (estado==0) {
		vineta='<i style="font-size: 25px;" class="fas fa-eye-slash"></i>';
		$('#showPass').html(vineta);
		$('#showPass').attr('data',1);
		$('#passR').attr('type','text');
	}else{
		vineta='<i style="font-size: 25px;" class="fas fa-eye"></i>';
		$('#showPass').html(vineta);
		$('#showPass').attr('data',0);
		$('#passR').attr('type','password');
	}
});

$('#showPassIni').click(function(){
	var vineta='';
	var estado=$('#showPassIni').attr('data');
	if (estado==0) {
		vineta='<i style="font-size: 25px;" class="fas fa-eye-slash"></i>';
		$('#showPassIni').html(vineta);
		$('#showPassIni').attr('data',1);
		$('#passi').attr('type','text');
	}else{
		vineta='<i style="font-size: 25px;" class="fas fa-eye"></i>';
		$('#showPassIni').html(vineta);
		$('#showPassIni').attr('data',0);
		$('#passi').attr('type','password');
	}
});

$('#showPassCp').click(function(){
	var vineta='';
	var estado=$('#showPassCp').attr('data');
	if (estado==0) {
		vineta='<i style="font-size: 25px;" class="fas fa-eye-slash"></i>';
		$('#showPassCp').html(vineta);
		$('#showPassCp').attr('data',1);
		$('#pass1').attr('type','text');
		$('#pass2').attr('type','text');
		$('#passCp').attr('type','text');
	}else{
		vineta='<i style="font-size: 25px;" class="fas fa-eye"></i>';
		$('#showPassCp').html(vineta);
		$('#showPassCp').attr('data',0);
		$('#pass1').attr('type','password');
		$('#pass2').attr('type','password');
		$('#passCp').attr('type','password');
	}
});

//*************************************************************************************************
//Cerrar secion
$('#cerrar').click(function(){

	var url='<?= base_url('perfil_controller/cerrar'); ?>';

	$.ajax({
		type: 'ajax',
		url: url,
		dataType: 'json',

		success: function(respuesta){
			if (respuesta=='Exito') {
				location.replace("home_controller");
			}
		}
	});
});

//*********************************************************************************************************************
//Boton btnCpass cambiar contraseña
$('#btnCpass').click(function(){
	$respuesta=validacionesCambiarPass();
	if ($respuesta==true) {

		$url = $('#formCpass').attr('action');
		$data = $('#formCpass').serialize();

		$('#cambiarPass').modal('hide');
		$.ajax({
			type: 'ajax',
			method: 'post',
			url: $url,
			data: $data,
			dataType: 'json',

			success: function(respuesta){

				if(respuesta=='Exito'){
					alertify.notify('Actualización de contraseña con exito!', 'success',10, null);

				}else{
					alertify.notify('Error al actualizar contraseña!', 'error',10, null);
				}
				restablecerCp();
			}
		});
	}

});

$('#cerrarCp').click(function(){
	restablecerCp();
});

function restablecerCp(){
	$('#pass1').css('box-shadow','none');
	$('#pass1').val("");
	$('#pass1').attr("placeholder", "Ingresa tu contraseña actual");
	$('#pass2').css('box-shadow','none');
	$('#pass2').val("");
	$('#pass2').attr("placeholder", "Ingresa tu contraseña actual");
	$('#passCp').css('box-shadow','none');
	$('#passCp').val("");
	$('#passCp').attr("placeholder", "Ingresa tu nueva contraseña");
	
	$(".alert").alert('close');
}

//----------------------------------------------------------------------------------------------------

//Validar correo
$('#correoR').blur(function(){
	$correo= $('#correoR').val();
	$.ajax({
		type: 'ajax',
		method: 'post',
		url:'<?php echo base_url('perfil_controller/validarCorreo') ?>',
		data: {correo:$correo},
		dataType: 'json',
		success: function(respuesta){
			if(respuesta==true) {
				$('#correoR').val("");
				$('#correoR').css('box-shadow','inset 0 0 15px red');
				var msj='';
				msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Ya existe una cuenta con el correo <strong>'+$correo+'</strong>.'+
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span>'+
				'</button></div>';
				$('#mensajeAlertaCorreo').html(msj);
			}else{
				$('#correoR').css('box-shadow','inset 0 0 15px green');
				var msj='';
				msj+='<div class="alert alert-success alert-dismissible fade show" role="alert">'+'Correo <strong>'+$correo+'</strong> disponible.'+
				'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
				'<span aria-hidden="true">&times;</span>'+
				'</button></div>';
				$('#mensajeAlertaCorreo').html(msj);
			}
		}
	});
});		

//**********************************************************************************************************
//Validar contraseña	

$('#passR').keyup(function(){
	var pswd = $(this).val();

	var passMsj='';
	passMsj+='<div class="alert alert-light alert-dismissible fade show" role="alert">'+'<table>'+
	'<tr><td><i id="largo-i" class="far fa-square"></i></td><td id="largo">Caracteres minimos: 8</td></tr>'+
	'<tr><td><i id="mayus-i" class="far fa-square"></i></td><td id="mayus">Carácter mayuscula</td></tr>'+
	'<tr><td><i id="numero-i" class="far fa-square"></i></td><td id="numero">Carácter número</td></tr>'+
	'<tr><td><i id="especial-i" class="far fa-square"></i></td><td id="especial">Carácter especial <i style="cursor: pointer" title="Ejemplo ~!¡@#$%^&*()+=-[]/{}|<>¿?" class="fas fa-info-circle text-info"></i></td></tr>'+
	'</table>'+
	'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
	'<span aria-hidden="true">&times;</span>'+
	'</button></div>';
	$('#mensajeAlertaPass').html(passMsj);

        //Validar logitud
        if ( pswd.length < 8 ) {
        	$('#largo').removeClass('text-success').addClass('text-danger');
        	$('#largo-i').removeClass('text-success').addClass('text-danger');
        	$('#largo-i').removeClass('fa-check-square').addClass('fa-square');
        } else {
        	$('#largo').removeClass('text-danger').addClass('text-success');
        	$('#largo-i').removeClass('text-danger').addClass('text-success');
        	$('#largo-i').removeClass('fa-square').addClass('fa-check-square');
        }

        //Validar caracter especial
        if ( pswd.match(/[~!@#$%\^&*()+=\-\[\]\/{}|\<>\?¿?¡]/) ) {
        	$('#especial').removeClass('text-danger').addClass('text-success');
        	$('#especial-i').removeClass('text-danger').addClass('text-success');
        	$('#especial-i').removeClass('fa-square').addClass('fa-check-square');
        } else {
        	$('#especial').removeClass('text-success').addClass('text-danger');
        	$('#especial-i').removeClass('text-success').addClass('text-danger');
        	$('#especial-i').removeClass('fa-check-square').addClass('fa-square');
        }

        //Validar mayuscula
        if ( pswd.match(/[A-Z]/) ) {
        	$('#mayus').removeClass('text-danger').addClass('text-success');
        	$('#mayus-i').removeClass('text-danger').addClass('text-success');
        	$('#mayus-i').removeClass('fa-square').addClass('fa-check-square');
        } else {
        	$('#mayus').removeClass('text-success').addClass('text-danger');
        	$('#mayus-i').removeClass('text-success').addClass('text-danger');
        	$('#mayus-i').removeClass('fa-check-square').addClass('fa-square');
        }

        //Validar numero
        if ( pswd.match(/\d/) ) {
        	$('#numero').removeClass('text-danger').addClass('text-success');
        	$('#numero-i').removeClass('text-danger').addClass('text-success');
        	$('#numero-i').removeClass('fa-square').addClass('fa-check-square');

        } else {
        	$('#numero').removeClass('text-success').addClass('text-danger');
        	$('#numero-i').removeClass('text-success').addClass('text-danger');
        	$('#numero-i').removeClass('fa-check-square').addClass('fa-square');

        }

    });//Fin Validar contraseña

//***************************************************************************************************
//Validar contraseña Cambiar contraseña

$('#passCp').keyup(function(){
	var pswd = $(this).val();

	var passMsj='';
	passMsj+='<div class="alert alert-light alert-dismissible fade show" role="alert">'+'<table>'+
	'<tr><td><i id="largo-i" class="far fa-square"></i></td><td id="largo">Caracteres minimos: 8</td></tr>'+
	'<tr><td><i id="mayus-i" class="far fa-square"></i></td><td id="mayus">Carácter mayuscula</td></tr>'+
	'<tr><td><i id="numero-i" class="far fa-square"></i></td><td id="numero">Carácter número</td></tr>'+
	'<tr><td><i id="especial-i" class="far fa-square"></i></td><td id="especial">Carácter especial <i style="cursor: pointer" title="Ejemplo ~!¡@#$%^&*()+=-[]/{}|<>¿?" class="fas fa-info-circle text-info"></i></td></tr>'+
	'</table>'+
	'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
	'<span aria-hidden="true">&times;</span>'+
	'</button></div>';
	$('#mensajeAlertaPassCp').html(passMsj);

        //Validar logitud
        if ( pswd.length < 8 ) {
        	$('#largo').removeClass('text-success').addClass('text-danger');
        	$('#largo-i').removeClass('text-success').addClass('text-danger');
        	$('#largo-i').removeClass('fa-check-square').addClass('fa-square');
        } else {
        	$('#largo').removeClass('text-danger').addClass('text-success');
        	$('#largo-i').removeClass('text-danger').addClass('text-success');
        	$('#largo-i').removeClass('fa-square').addClass('fa-check-square');
        }

        //Validar caracter especial
        if ( pswd.match(/[~!@#$%\^&*()+=\-\[\]\/{}|\<>\?¿?¡]/) ) {
        	$('#especial').removeClass('text-danger').addClass('text-success');
        	$('#especial-i').removeClass('text-danger').addClass('text-success');
        	$('#especial-i').removeClass('fa-square').addClass('fa-check-square');
        } else {
        	$('#especial').removeClass('text-success').addClass('text-danger');
        	$('#especial-i').removeClass('text-success').addClass('text-danger');
        	$('#especial-i').removeClass('fa-check-square').addClass('fa-square');
        }

        //Validar mayuscula
        if ( pswd.match(/[A-Z]/) ) {
        	$('#mayus').removeClass('text-danger').addClass('text-success');
        	$('#mayus-i').removeClass('text-danger').addClass('text-success');
        	$('#mayus-i').removeClass('fa-square').addClass('fa-check-square');
        } else {
        	$('#mayus').removeClass('text-success').addClass('text-danger');
        	$('#mayus-i').removeClass('text-success').addClass('text-danger');
        	$('#mayus-i').removeClass('fa-check-square').addClass('fa-square');
        }

        //Validar numero
        if ( pswd.match(/\d/) ) {
        	$('#numero').removeClass('text-danger').addClass('text-success');
        	$('#numero-i').removeClass('text-danger').addClass('text-success');
        	$('#numero-i').removeClass('fa-square').addClass('fa-check-square');

        } else {
        	$('#numero').removeClass('text-success').addClass('text-danger');
        	$('#numero-i').removeClass('text-success').addClass('text-danger');
        	$('#numero-i').removeClass('fa-check-square').addClass('fa-square');

        }

    });//Fin Validar contraseña
//******************************************************************************************************
//VALIDACIONES
//Ingresar
function validacionesIngresar(){

				//Validacion correo
				$correo= $('#correoi').val();
				if ($correo.length==0) {
					$('#correoi').css('box-shadow','inset 0 0 15px red');
					$('#correoi').attr("placeholder", "Este campo es obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Campo <strong>correo</strong> vacio.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}else{
					$(".alert").alert('close');
					$('#correoi').css('box-shadow','none');
				}

				if(!(/\S+@\S+\.\S+/.test($correo))){
					$('#correoi').css('box-shadow','inset 0 0 15px red');
					$('#correoi').attr("placeholder", "Campo obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Formato <strong>correo</strong> erroneo.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}else{
					$(".alert").alert('close');
					$('#correoi').css('box-shadow','none');
				}

        //Validar contrasenia
        if ( $('#passi').val() ==0) {
        	$('#passi').css('box-shadow','inset 0 0 15px red');
        	$('#passi').attr("placeholder", "Este campo es obligatorio");
        	return	false;
        }
				//**************************************************
				return true;
			}

		//Mascaras

		//Correo evitamos que agregue espacios
		$("#correoi").on({
			keydown: function(e) {
				if (e.which === 32)
					return false;
			},
			change: function() {
				this.value = this.value.replace(/\s/g, "");
			}
		});

				//Contraseña evitamos que agregue espacios
				$("#passi").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});



//************************************************************************************************************************
//Longitud maxima

//Correo
$('#correoi').keydown(function(){
	$correo=$('#correoi').val();
	if ($correo.length<50){
		return true;
	}
	else {
		$('#correoi').val("");
		$('#correoi').attr("placeholder", "¡Caracteres max 50!");
		$('#correoi').css('box-shadow','inset 0 0 15px red');
	}
});

				//Contraseña
				$('#passi').keydown(function(){
					$pass=$('#passi').val();
					if ($pass.length<20){
						return true;
					}
					else {
						$('#passi').val("");
						$('#passi').attr("placeholder", "¡Caracteres max 20!");
						$('#passi').css('box-shadow','inset 0 0 15px red');
					}
				});


//*************************************************************************************
//Recuperacion de cuenta
function validacionesRecovery(){

				//Validacion correo
				$correo= $('#RecoveryCorreo').val();
				if ($correo.length==0) {
					$('#RecoveryCorreo').css('box-shadow','inset 0 0 15px red');
					$('#RecoveryCorreo').attr("placeholder", "Este campo es obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Campo <strong>correo</strong> vacio.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlertaRecovery').html(msj);
					return	false;
				}else{
					$(".alert").alert('close');
					$('#RecoveryCorreo').css('box-shadow','none');
				}

				if(!(/\S+@\S+\.\S+/.test($correo))){
					$('#RecoveryCorreo').css('box-shadow','inset 0 0 15px red');
					$('#RecoveryCorreo').attr("placeholder", "Campo obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Formato <strong>correo</strong> erroneo.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlertaRecovery').html(msj);
					return	false;
				}else{
					$(".alert").alert('close');
					$('#RecoveryCorreo').css('box-shadow','none');
				}
				//--------------------------
				return true;
			}

				//Mascaras

		//Correo evitamos que agregue espacios
		$("#RecoveryCorreo").on({
			keydown: function(e) {
				if (e.which === 32)
					return false;
			},
			change: function() {
				this.value = this.value.replace(/\s/g, "");
			}
		});

		//Correo longitud maxima
		$('#RecoveryCorreo').keydown(function(){
			$correo=$('#RecoveryCorreo').val();
			if ($correo.length<50){
				return true;
			}
			else {
				$('#RecoveryCorreo').val("");
				$('#RecoveryCorreo').attr("placeholder", "¡Caracteres max 50!");
				$('#RecoveryCorreo').css('box-shadow','inset 0 0 15px red');
			}
		});

//******************************************************************************************************
//VALIDACIONES
//Registrarse
function validacionesRegistrarse(){

				//Validacion Nombre
				$nombre= $('#nombreR').val();
				if ($nombre.length==0) {
					$('#nombreR').css('box-shadow','inset 0 0 15px red');
					$('#nombreR').attr("placeholder", "Este campo es obligatorio");
					return	false;
				}else{
					$('#nombreR').css('box-shadow','inset 0 0 15px green');
				}

				//Validacion Apellido
				$apellido= $('#apellidoR').val();
				if ($apellido.length==0) {
					$('#apellidoR').css('box-shadow','inset 0 0 15px red');
					$('#apellidoR').attr("placeholder", "Este campo es obligatorio");
					return	false;
				}else{
					$('#apellidoR').css('box-shadow','inset 0 0 15px green');
				}

				//Validacion correo
				$correo= $('#correoR').val();
				if ($correo.length==0) {
					$('#correoR').css('box-shadow','inset 0 0 15px red');
					$('#correoR').attr("placeholder", "Este campo es obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Campo <strong>correo</strong> vacio.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlertaCorreo').html(msj);
					return	false;
				}else{
					$(".alert").alert('close');
					$('#correoR').css('box-shadow','none');
				}

				if(!(/\S+@\S+\.\S+/.test($correo))){
					$('#correoR').css('box-shadow','inset 0 0 15px red');
					$('#correoR').attr("placeholder", "Campo obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Formato <strong>correo</strong> erroneo.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlertaCorreo').html(msj);
					return	false;
				}else{
					$(".alert").alert('close');
					$('#correoR').css('box-shadow','none');
				}

        //Validar contrasenia
        if ( $('#passR').val() ==0) {
        	$('#passR').css('box-shadow','inset 0 0 15px red');
        	$('#passR').attr("placeholder", "Este campo es obligatorio");
        	return	false;
        }

        $pswd= $('#passR').val();
        //Validar logitud
        if ( $pswd.length < 8 ) {
        	$('#passR').css('box-shadow','inset 0 0 15px red');
        	return	false;
        }

        //Validar caracter especial
        if ( $pswd.match(/[~!@#$%\^&*()+=\-\[\]\/{}|\<>\?¿?¡]/) ) {
        	$('#passR').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#passR').css('box-shadow','inset 0 0 15px red');
        	return	false;
        }

        //Validar mayuscula
        if ( $pswd.match(/[A-Z]/) ) {
        	$('#passR').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#passR').css('box-shadow','inset 0 0 15px red');
        	return	false;
        }

        //Validar numero
        if ( $pswd.match(/\d/) ) {
        	$('#passR').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#passR').css('box-shadow','inset 0 0 15px red');
        	return	false;

        }
				//**************************************************
				return true;
			}

		//Mascaras

		//Correo evitamos que agregue espacios
		$("#correoR").on({
			keydown: function(e) {
				if (e.which === 32)
					return false;
			},
			change: function() {
				this.value = this.value.replace(/\s/g, "");
			}
		});

				//Contraseña evitamos que agregue espacios
				$("#passR").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});



//************************************************************************************************************************
//Longitud maxima
//Nombre
$('#nombreR').keydown(function(){
	$nombre=$('#nombreR').val();
	if ($nombre.length<50){
		return true;
	}
	else {
		$('#nombreR').val("");
		$('#nombreR').attr("placeholder", "¡Caracteres max 50!");
		$('#nombreR').css('box-shadow','inset 0 0 15px red');
	}
});

//Apellido
$('#apellidoR').keydown(function(){
	$apellido=$('#apellidoR').val();
	if ($apellido.length<50){
		return true;
	}
	else {
		$('#apellidoR').val("");
		$('#apellidoR').attr("placeholder", "¡Caracteres max 50!");
		$('#apellidoR').css('box-shadow','inset 0 0 15px red');
	}
});

//Correo
$('#correoR').keydown(function(){
	$correo=$('#correoR').val();
	if ($correo.length<50){
		return true;
	}
	else {
		$('#correoR').val("");
		$('#correoR').attr("placeholder", "¡Caracteres max 50!");
		$('#correoR').css('box-shadow','inset 0 0 15px red');
	}
});

				//Contraseña
				$('#passR').keydown(function(){
					$pass=$('#passR').val();
					if ($pass.length<20){
						return true;
					}
					else {
						$('#passR').val("");
						$('#passR').attr("placeholder", "¡Caracteres max 20!");
						$('#passR').css('box-shadow','inset 0 0 15px red');
					}
				});

//******************************************************************************************************
//VALIDACIONES
//Cambiar contraseña
function validacionesCambiarPass(){

        //Validar contrasenias
        if ( $('#pass1').val() ==0) {
        	$('#pass1').css('box-shadow','inset 0 0 15px red');
        	$('#pass1').attr("placeholder", "Este campo es obligatorio");
        	return	false;
        }else{
        	$('#pass1').css('box-shadow','inset 0 0 15px green');
        }

         if ( $('#pass2').val() ==0) {
        	$('#pass2').css('box-shadow','inset 0 0 15px red');
        	$('#pass2').attr("placeholder", "Este campo es obligatorio");
        	return	false;
        }else{
        	$('#pass2').css('box-shadow','inset 0 0 15px green');
        }

         //Contraseña actual no coincide
        $pass1= $('#pass1').val();
        $pass2= $('#pass2').val();
      
        if ($pass1!=$pass2) {
        	$('#pass1').css('box-shadow','inset 0 0 15px red');
        	$('#pass2').css('box-shadow','inset 0 0 15px red');
        	var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'<strong>No coinciden</strong> los campos de contraseña actual.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlertaChangePass').html(msj);
					return	false;
        }else{
        	$('#pass1').css('box-shadow','inset 0 0 15px green');
        	$('#pass2').css('box-shadow','inset 0 0 15px green');
        	$(".alert").alert('close');
        }


         if ( $('#passCp').val() ==0) {
        	$('#passCp').css('box-shadow','inset 0 0 15px red');
        	$('#passCp').attr("placeholder", "Este campo es obligatorio");
        	return	false;
        }


        $pswd= $('#passCp').val();
        //Validar logitud
        if ( $pswd.length < 8 ) {
        	$('#passCp').css('box-shadow','inset 0 0 15px red');
        	return	false;
        }

        //Validar caracter especial
        if ( $pswd.match(/[~!@#$%\^&*()+=\-\[\]\/{}|\<>\?¿?¡]/) ) {
        	$('#passCp').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#passCp').css('box-shadow','inset 0 0 15px red');
        	return	false;
        }

        //Validar mayuscula
        if ( $pswd.match(/[A-Z]/) ) {
        	$('#passCp').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#passCp').css('box-shadow','inset 0 0 15px red');
        	return	false;
        }

        //Validar numero
        if ( $pswd.match(/\d/) ) {
        	$('#passCp').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#passCp').css('box-shadow','inset 0 0 15px red');
        	return	false;

        }
				//**************************************************
				return true;
			}

		//Mascaras
				//Contraseña evitamos que agregue espacios
				$("#pass1").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});

				$("#pass2").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});

				$("#passCp").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});



//************************************************************************************************************************
//Longitud maxima
				//Contraseña
				$('#pass1').keydown(function(){
					$pass1=$('#pass1').val();
					if ($pass1.length<20){
						return true;
					}
					else {
						$('#pass1').val("");
						$('#pass1').attr("placeholder", "¡Caracteres max 20!");
						$('#pass1').css('box-shadow','inset 0 0 15px red');
					}
				});

				$('#pass2').keydown(function(){
					$pass2=$('#pass2').val();
					if ($pass2.length<20){
						return true;
					}
					else {
						$('#pass2').val("");
						$('#pass2').attr("placeholder", "¡Caracteres max 20!");
						$('#pass2').css('box-shadow','inset 0 0 15px red');
					}
				});

				$('#passCp').keydown(function(){
					$passCp=$('#passCp').val();
					if ($passCp.length<20){
						return true;
					}
					else {
						$('#passCp').val("");
						$('#passCp').attr("placeholder", "¡Caracteres max 20!");
						$('#passCp').css('box-shadow','inset 0 0 15px red');
					}
				});


	});//Final de Document Ready


</script>