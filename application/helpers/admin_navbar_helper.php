<script type="text/javascript">

	$(document).ready(function(){

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

			});
		</script>