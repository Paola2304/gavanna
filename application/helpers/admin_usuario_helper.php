<script type="text/javascript">
	$(document).ready(function(){

//**************************************************************************************************************

		// FUNCION MOSTRAR
		mostrarUsuario();
		function mostrarUsuario(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('admin_usuario_controller/get_usuario'); ?>',
				dataType: 'json',

				success: function(datos){
					var tabla=''; 
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
						'<td>'+datos[i].correo+'</td>'+
						'<td>'+datos[i].rol+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_usuario+'">Eliminar</a>'+
						'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_usuario+'">Editar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_usuario').html(tabla);
				}


			});
		}//FIN FUNCION MOSTRAR
//**************************************************************************************************************

		//Funcion para limpiar inputs
		function restablecerInputs()
		{
			$('#nombre').css('box-shadow','none');
			$('#nombre').attr("placeholder", "");
			$('#apellido').css('box-shadow','none');
			$('#apellido').attr("placeholder", "");
			$('#correo').css('box-shadow','none');
			$('#correo').attr("placeholder", "");
			$('#pass').css('box-shadow','none');
			$('#rol').css('box-shadow','none');
			$(".alert").alert('close');
		}//FIN Funcion para limpiar inputs
//**************************************************************************************************************

$('#showPass').click(function(){
	var vineta='';
	var estado=$('#showPass').attr('data');
	if (estado==0) {
		vineta='<i style="font-size: 25px;" class="fas fa-eye-slash"></i>';
		$('#showPass').html(vineta);
		$('#showPass').attr('data',1);
		$('#pass').attr('type','text');
	}else{
		vineta='<i style="font-size: 25px;" class="fas fa-eye"></i>';
		$('#showPass').html(vineta);
		$('#showPass').attr('data',0);
		$('#pass').attr('type','password');
	}
});
//**************************************************************************************************************

get_rol();//llamado a la funcion para mostrar Rol

function get_rol(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_usuario_controller/get_rol') ?>',
				//Tipo de respuesta que recibiremos
				dataType: 'json',

				//Si la peticion fue exitosa recibiremos una respuesta, en este caso en la variable "respuesta" recibiremos 
				//los registros de la tabla sexo
				success: function(datos){
					//Creamos una variable que servira para crear los option del select
					var op = '';
					//variable para recorrer el for
					var i;

					//agregamos a op un option vacio para que no aparezca ninguna opcion seleccionada
					op +="<option value=''>--Seleccione una opción--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option value='"+datos[i].id_rol+"'>"+datos[i].rol+"</option>";
					}
					//al select con el id sexo le entregamos la variable op que contiene los option
					$('#rol').html(op);
				}
			});
		}//fin de funcion para mostrar rol
		//Restaurar vista tabla
		$('#reload').click(function(){
			mostrarUsuario();
		});

//**************************************************************************************************************


		//Buscador
		$("#buscar").keypress(function(){
			$data = $("#buscar").val();

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_usuario_controller/buscar') ?>',
				data: {palabra:$data},
				dataType: 'json',
				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
						'<td>'+datos[i].correo+'</td>'+
						'<td>'+datos[i].rol+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_usuario+'">Eliminar</a>'+
						'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_usuario+'">Editar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_usuario').html(tabla);
				},
			});
		}); //Fin funcion buscar

//**************************************************************************************************************
	//Borrar
	$('#tabla_usuario').on('click','.borrar', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click

			$('#modalBorrar').modal('show'); //Para mostrar el modal de eliminar

			$('#btnBorrar').unbind().click(function(){ //Unbind sirve para que elimine cuando le de aceptar en el boton del modal
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_usuario_controller/eliminar') ?>',
					data: {id:$id},
					dataType: 'json',

					success: function(respuesta){
						 $('#modalBorrar').modal('hide');//Escondemos el modal de eliminar
						 if (respuesta==true) {
						 	alertify.notify('Eliminado exitosamente', 'success',10,null);
						 	mostrarUsuario();
						 }else{
						 	alertify.notify('Error al eliminar', 'error',10,null);
						 }
						}
					});
			});

		});//Fin funcion borrar

//**************************************************************************************************************


		//Abrir formulario ingresar
		$('#nueUsu').click(function(){

			$('#pass').removeAttr('value');
			$('#rowPass').removeAttr("style");//Removemos el stilo de ocultar para mostrar el input contraseña
			//mostramos el modal que tiene el formulario para ingresar un alumno
			$('#usuario').modal('show');

			//modificamos el titulo del modal
			$('#usuario').find('.modal-title').text('Nuevo usuario');
			//modificamos el atributo action, le agregamos la ruta del controlador y modelo para ingresar
			$('#formUsuario').attr('action','<?= base_url('admin_usuario_controller/ingresar')?>');
			$('#id').val('0');
			restablecerInputs();
		});



//**************************************************************************************************************

//agregamos un evento al boton del modal GUARDAR
$('#btnGuardar').click(function(){
	$respuesta=validaciones();
	if ($respuesta==true) {

			//capturamos lo que este en el atributo action del formulario
			$url = $('#formUsuario').attr('action');
			//capturamos todos los datos del formulario
			$data = $('#formUsuario').serialize();

			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//metodo de envio de los datos (puede ser get)
				method: 'post',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: $url,
				//datos a enviar, $data contiene TODA la informacion del formulario
				data: $data,
				//Tipo de respuesta que recibiremos
				dataType: 'json',

				//Si la peticion fue exitosa recibiremos una respuesta, en este caso en la variable "respuesta" recibiremos la palabra add o edi
				//add la recibiremos cuando una insercion fue exitosa
				//edi la recibiremos cuando una actualizacion fue exitosa
				success: function(respuesta){
					//Ocultamos el moda, hide significa "oculto"
					$('#usuario').modal('hide');
					//si la respuesta recibida es add mostramos una alerta de ingreso exitoso
					if(respuesta=='add'){
						//si la respuesta que recibimos del modelo es ADD, mostramos una alerta indicando
						//que el registro fue ingresado exitosamente
						//success tipo de notificacion ---- 10 segundos a mostrar la alerta
						alertify.notify('Ingresado exitosamente!', 'success',10, null);
					}else if(respuesta=='edi'){
						//si la respuesta que recibimos del modelo es EDI, mostramos una alerta indicando
						//que el registro fue actualizado exitosamente
						//success tipo de notificacion ---- 10 segundos a mostrar la alerta
						alertify.notify('Actualizado exitosamente!', 'success',10, null);
					}else{
						//si la respuesta que recibimos del modelo es NO ES ADD o EDI, mostramos una alerta indicando que hubi error al realizar la accion (ya sea insertar o actualizar)
						//error tipo de notificacion ---- 10 segundos a mostrar la alerta
						alertify.notify('error al ingresar!', 'error',10, null);
					}
					//Limpiar inputs de formulario
					$('#formUsuario')[0].reset();
					//Actualizar la tabla con el nuevo registro
					mostrarUsuario();
				}
			});
		}
		});//fin evento del boton guardar del modal



//**************************************************************************************************************

			//cuando damos click al boton de editar de cada registro de la tabla_alumnos se ejecutara lo siguiente	
			$('#tabla_usuario').on('click', '.item-edit', function(){
				restablecerInputs();
			//para capturar el dato segun el boton que demos click
			$('#pass').attr('value','Prueba#0');
			$('#rowPass').attr('style','display: none');//para actualizar escondemos el input contraseña
			var id = $(this).attr('data');

			$('#usuario').modal('show');//Para mostrar el modal 
			//en el modal que tiene id llamado alumno buscamos la clase "modal-title" y le agregamos el texto del encabezado
			$('#usuario').find('.modal-title').text('Editar usuario');
			//modificamos el atributo action, le agregamos la ruta del controlador y modelo para actualizar
			$('#formUsuario').attr('action','<?= base_url('admin_usuario_controller/actualizar')?>');

			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//metodo de envio de los datos (puede ser get)
				method: 'post',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_usuario_controller/get_datos')?>',
				//datos a enviar, id contiene el id del registro que queremos obtener los datos para mostrarlos en el modal
				data: {id:id},
				//Tipo de respuesta que recibiremos
				dataType: 'json',

				//Si la peticion fue exitosa recibiremos una respuesta, en este caso en la variable "datos" recibiremos la palabra los datos del registro que enviamos el id
				//add la recibiremos cuando una insercion fue exitosa
				//edi la recibiremos cuando una actualizacion fue exitosa
				success: function(datos){
					//en el input del formulario con id "id" colocamos la informacion del campo id_usuario
					$('#id').val(datos.id_usuario);
					//en el input del formulario con id "nombre" colocamos la informacion del campo nombre
					$('#nombre').val(datos.nombre);
					//en el input del formulario con id "apellido" colocamos la informacion del campo apellido
					$('#apellido').val(datos.apellido);
					//en el input del formulario con id "correo" colocamos la informacion del campo correo
					$('#correo').val(datos.correo);
					//en el input del formulario con id "rol" colocamos la informacion del campo id_rol
					$('#rol').val(datos.id_rol);
				}
			});
		});//fin de evento editar

		//Limpiamos el formulario al clickear cerrar
		$('#cerrar').click(function(){
			$('#formUsuario')[0].reset();
			$('#id').val('0');
			$(".alert").alert('close');
		});


//**************************************************************************************************************

//VALIDACIONES
function validaciones(){
				//Validacion Nombre
				$nombre= $('#nombre').val();
				if ($nombre.length==0) {
					$('#nombre').css('box-shadow','inset 0 0 15px red');
					$('#nombre').attr("placeholder", "Este campo es obligatorio");
					return	false;
				}else{
					$('#nombre').css('box-shadow','inset 0 0 15px green');
				}

				//Validacion Apellido
				$apellido= $('#apellido').val();
				if ($apellido.length==0) {
					$('#apellido').css('box-shadow','inset 0 0 15px red');
					$('#apellido').attr("placeholder", "Este campo es obligatorio");
					return	false;
				}else{
					$('#apellido').css('box-shadow','inset 0 0 15px green');
				}

				//Validacion correo
				$correo= $('#correo').val();
				if ($correo.length==0) {
					$('#correo').css('box-shadow','inset 0 0 15px red');
					$('#correo').attr("placeholder", "Este campo es obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Campo <strong>correo</strong> vacio.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}
				if(!(/\S+@\S+\.\S+/.test($correo))){
					$('#correo').css('box-shadow','inset 0 0 15px red');
					$('#correo').attr("placeholder", "Campo obligatorio");
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Formato <strong>correo</strong> erroneo.'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}else{
					$('#correo').css('box-shadow','inset 0 0 15px green');
				}

				//Validacion Rol
				$rol=$("#rol")[0].selectedIndex;
				if ($rol==0) {
					$('#rol').css('box-shadow','inset 0 0 15px red');
					return	false;
				}else{
					$('#rol').css('box-shadow','inset 0 0 15px green');
				}

				//Validacion Nombre
				$pswd= $('#pass').val();
				if ($pswd.length==0) {
					$('#pass').css('box-shadow','inset 0 0 15px red');
					$('#pass').attr("placeholder", "Este campo es obligatorio");
					return	false;
				}

        //Validar logitud
        if ( $pswd.length < 8 ) {
        	$('#pass').css('box-shadow','inset 0 0 15px red');
					return	false;
        }

        //Validar caracter especial
        if ( $pswd.match(/[~!@#$%\^&*()+=\-\[\]\/{}|\<>\?¿?¡]/) ) {
        	$('#pass').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#pass').css('box-shadow','inset 0 0 15px red');
					return	false;
        }

        //Validar mayuscula
        if ( $pswd.match(/[A-Z]/) ) {
        	$('#pass').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#pass').css('box-shadow','inset 0 0 15px red');
					return	false;
        }

        //Validar numero
        if ( $pswd.match(/\d/) ) {
        	$('#pass').css('box-shadow','inset 0 0 15px green');
        } else {
        	$('#pass').css('box-shadow','inset 0 0 15px red');
					return	false;

        }

				//**************************************************
				return true;
			}

//**********************************************************************************************************
				//Validar correo
				$('#correo').blur(function(){
					$id= $('#id').val();
					$correo= $('#correo').val();

					
					$.ajax({
						type: 'ajax',
						method: 'post',
						url:'<?php echo base_url('admin_usuario_controller/validarCorreo') ?>',
						data: {correo:$correo},
						dataType: 'json',
						success: function(respuesta){
							if(respuesta!=0 && $id==0) {
								$('#correo').val("");
								$('#correo').css('box-shadow','inset 0 0 15px red');
								var msj='';
								msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Correo <strong>'+$correo+'</strong> no disponible.'+
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
								'<span aria-hidden="true">&times;</span>'+
								'</button></div>';
								$('#mensajeAlerta').html(msj);
							}else if(respuesta!=0 && $id!=0){
								//Al editar correo
								if (respuesta.id_usuario==$id) {
									$(".alert").alert('close');
									$('#correo').css('box-shadow','none');
								}else if(respuesta.id_usuario!=$id){
									$('#correo').val("");
									$('#correo').css('box-shadow','inset 0 0 15px red');
									var msj='';
									msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Correo <strong>'+$correo+'</strong> no disponible.'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
									'<span aria-hidden="true">&times;</span>'+
									'</button></div>';
									$('#mensajeAlerta').html(msj);

								}else{
									$('#correo').css('box-shadow','inset 0 0 15px green');
									var msj='';
									msj+='<div class="alert alert-success alert-dismissible fade show" role="alert">'+'Correo <strong>'+$correo+'</strong> disponible.'+
									'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
									'<span aria-hidden="true">&times;</span>'+
									'</button></div>';
									$('#mensajeAlerta').html(msj);
								}

								//FIN Al editar correo

							}else{
								$('#correo').css('box-shadow','inset 0 0 15px green');
								var msj='';
								msj+='<div class="alert alert-success alert-dismissible fade show" role="alert">'+'Correo <strong>'+$correo+'</strong> disponible.'+
								'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
								'<span aria-hidden="true">&times;</span>'+
								'</button></div>';
								$('#mensajeAlerta').html(msj);
							}
						}
					});
				});		

				//FIN Validar correo		
//**********************************************************************************************************
//Validar contraseña	

$('#pass').keyup(function(){
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
//**********************************************************************************************************

				//Mascaras
				//Nombre evitamos caracteres especiales y numeros
				$("#nombre").keypress(function(event) {
					var character = String.fromCharCode(event.keyCode);
					return isValid(character);     
				});
				function isValid(str) {
					return !/[~`!@#$%\^&*()+=\-\[\]\';,/{}|\":<>\?0123456789.¿?¡]/g.test(str);
				}
				//Apellido evitamos caracteres especiales y numeros
				$("#apellido").keypress(function(event) {
					var character = String.fromCharCode(event.keyCode);
					return isValid(character);     
				});
				function isValid(str) {
					return !/[~`!@#$%\^&*()+=\-\[\]\';,/{}|\":<>\?0123456789.¿?¡]/g.test(str);
				}

				//Correo evitamos que agregue espacios
				$("#correo").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});

				//Contraseña evitamos que agregue espacios
				$("#pass").on({
					keydown: function(e) {
						if (e.which === 32)
							return false;
					},
					change: function() {
						this.value = this.value.replace(/\s/g, "");
					}
				});


				//Aplicamos longitud maxima a los input
				//Nombre
				$('#nombre').keydown(function(){
					$nombre=$('#nombre').val();
					if ($nombre.length<50){
						return true;
					}
					else {
						$('#nombre').val("");
						$('#nombre').attr("placeholder", "¡Caracteres max 50!");
						$('#nombre').css('box-shadow','inset 0 0 15px red');
					}
				});
				//Apellido
				$('#apellido').keydown(function(){
					$nombre=$('#apellido').val();
					if ($nombre.length<50){
						return true;
					}
					else {
						$('#apellido').val("");
						$('#apellido').attr("placeholder", "¡Caracteres max 50!");
						$('#apellido').css('box-shadow','inset 0 0 15px red');
					}
				});

				//Correo
				$('#correo').keydown(function(){
					$correo=$('#correo').val();
					if ($correo.length<50){
						return true;
					}
					else {
						$('#correo').val("");
						$('#correo').attr("placeholder", "¡Caracteres max 50!");
						$('#correo').css('box-shadow','inset 0 0 15px red');
					}
				});

				//Contraseña
				$('#pass').keydown(function(){
					$pass=$('#pass').val();
					if ($pass.length<20){
						return true;
					}
					else {
						$('#pass').val("");
						$('#pass').attr("placeholder", "¡Caracteres max 20!");
						$('#pass').css('box-shadow','inset 0 0 15px red');
					}
				});





	});	// Document ready







</script>

<style type="text/css">
	/* Estilos para los input y label del formulario */
	label{
		font-weight: bold;
		margin-right: 5px;
	}

	.inp{
		margin-bottom: 5px;
		width: 100%;
	}
</style>