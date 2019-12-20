<script type="text/javascript">
	$(document).ready(function(){
		//Funcion mostrar
		mostrarDireccion();
		function mostrarDireccion(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('admin_direccion_controller/get_direccion'); ?>',
				dataType: 'json',

				success: function(datos){
					var tabla = '';
					var i;
					var n = 1;

					for(i = 0; i<datos.length; i++){
						tabla += '<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
						'<td>'+datos[i].nombre_departamento+'</td>'+
						'<td>'+datos[i].nombre_municipio+'</td>'+
						'<td>'+datos[i].direccion+'</td>'+
						'<td>'+datos[i].telefono+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_direccion+'">Eliminar</a>'+
						'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_direccion+'">Editar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_direccion').html(tabla);
				}
			});
		}// Fin funcion mostrar
//*******************************************************************************************************************

/*$('#buscador').keyup(function(){

	$id = $("#buscador").val();

	
	$.ajax({

		type: 'ajax',
		method: 'post',
		url: '<?php //echo base_url('admin_direccion_controller/buscar') ?>',
		data: {buscador:$id},
		dataType: 'json',

		success: function(datas){
			$datos="";

			$i=0;
			for ($i=0; $i<datas.length; $i++) {
				$datos+= "<option value='"+datas[$i].id_usuario+"'>"+datas[$i].nombre+"</option>";
			}
			$('#usuario').html($datos);
		},
	});
	
});*/


//*******************************************************************************************************************

		//Funcion eliminar
		$('#tabla_direccion').on('click','.borrar', function(){
			$id = $(this).attr('data');

			$('#modalBorrar').modal('show');

			$('#btnBorrar').unbind().click(function(){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_direccion_controller/eliminar')?>',
					data: {id:$id},
					dataType: 'json',

					success: function(respuesta){
						$('#modalBorrar').modal('hide');
						if(respuesta == true){
							alertify.notify('Eliminado con éxito', 'success',10,null);
							mostrarDireccion();
						}else{
							alertify.notify('Error al eliminar', 'error',10,null);
						}
					}
				});
			});
		});//Fin de funcion eliminar

//**************************************************************************************************************


		//agregamos un evento al boton para agregar nuevo alumno
		$('#nueDir').click(function(){
			$('#direccion').modal('show');
			$('#ocusuario').show();
			$('#ocusuario2').hide();
			//modificamos el titulo del modal
			$('#direccion').find('.modal-title').text('Nueva Direccion');
			//modificamos el atributo action, le agregamos la ruta del controlador y modelo para ingresar
			$('#formDireccion').attr('action','<?= base_url('admin_direccion_controller/ingresar')?>');
		});
		

//**************************************************************************************************************


get_usuario();//llamado a la funcion para mostrar Usuario

function get_usuario(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_direccion_controller/get_usuario') ?>',
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
						op +="<option value='"+datos[i].id_usuario+"'>"+datos[i].nombre+"</option>";
					}
					//al select con el id sexo le entregamos la variable op que contiene los option
					$('#usuario').html(op);
				}
			});
		}///fin de funcion

			get_departamento();//llamado a la funcion para mostrar Usuario

			function get_departamento(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_direccion_controller/get_departamento') ?>',
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
					op +="<option value=''>--Seleccione un departamento--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option data='"+datos[i].id_departamento+"' value='"+datos[i].id_departamento+"'>"+datos[i].nombre_departamento+"</option>";
					}
					//al select con el id sexo le entregamos la variable op que contiene los option
					$('#departamento').html(op);
				}
			});
		}//fin de funcion

//--------------------------------------------------------------------------------------
$('#departamento').change(function () {
	var id = $("#departamento").val();
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?= base_url('admin_direccion_controller/get_municipio') ?>',
		data:{id:id},
		dataType: 'json',

		success: function(datos){
			var op = '';
			var i;

			op +="<option value=''>--Seleccione un municipio--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option value='"+datos[i].id_municipio+"'>"+datos[i].nombre_municipio+"</option>";
					}
					$('#municipio').html(op);
				}
			});
	
});

//**************************************************************************************************************

//agregamos un evento al boton del modal GUARDAR
$('#btnGuardar').click(function(){
	$resp=validarFormulario();
	$url = $('#formDireccion').attr('action');
	$data = $('#formDireccion').serialize();
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: $url,
		data: $data,
		dataType: 'json',

		success: function(respuesta){
			$('#direccion').modal('hide');
			if(respuesta=='add'){
				alertify.notify('Ingresado exitosamente!', 'success',10, null);
			}else if(respuesta=='edi'){
				alertify.notify('Actualizado exitosamente!', 'success',10, null);
			}else{
				alertify.notify('Error al ingresar!', 'error',10, null);
			}
			$('#formDireccion')[0].reset();
			mostrarDireccion();
		}
	});

		});//fin evento del boton guardar del modal

//**************************************************************************************************************

//Editar
$('#tabla_direccion').on('click', '.item-edit', function(){
	var id = $(this).attr('data');
	$('#ocusuario').hide();
	$('#ocusuario2').show();

			$('#direccion').modal('show');//Para mostrar el modal 
			$('#direccion').find('.modal-title').text('Editar direccion');
			$('#formDireccion').attr('action','<?= base_url('admin_direccion_controller/actualizar')?>');

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_direccion_controller/get_datos')?>',
				data: {id:id},
				dataType: 'json',
				success: function(datos){
					$('#id').val(datos.id_direccion);
					$('#usuario2').val(datos.usuario);
					$('#departamento').val(datos.id_departamento);
					var id_d = datos.id_departamento;
					llenar_municipio(id_d);
					$('#municipio').val(datos.id_municipio);
					$('#txtdireccion').val(datos.direccion);
					$('#telefono').val(datos.telefono);
				}
			});
		});//fin de evento editar

		//Limpiamos el formulario al clickear cerrar
		$('#cerrar').click(function(){
			$('#formDireccion')[0].reset();
		});

		function llenar_municipio($id){
			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_direccion_controller/get_municipio') ?>',
				data:{id:$id},
				async: false,
				dataType: 'json',

				success: function(datos){
					var op = '';
					var i;

					op +="<option value=''>--Seleccione un municipio--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option value='"+datos[i].id_municipio+"'>"+datos[i].nombre_municipio+"</option>";
					}
					$('#municipio').html(op);
				}
			});
		}



//**************************************************************************************************************

//Validaciones

function validarFormulario(){

	$nombre   = $('#xx').val();
	$departamento   = $('#departamento option:selected').val();
	$municipio   = $('#municipio option:selected').val();
	$direccion = $('#direccion').val();
	$telefono = $('#telefono').val();


    //Validar campo obligatorio
    //Validar comboBox
    if($nombre == 0){
    	document.getElementById("xx").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("xx").style.boxShadow =  'inset 0 0 15px green';
    	
    }

    //Validar campo obligatorio
    //Validar comboBox
    if($departamento == 0){
    	document.getElementById("departamento").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("departamento").style.boxShadow =  'inset 0 0 15px green';
    	
    }

     //Validar comboBox
     if($municipio == 0){
     	document.getElementById("municipio").style.boxShadow = 'inset 0 0 15px red'; 
     	return false;
     }else{
     	document.getElementById("municipio").style.boxShadow =  'inset 0 0 15px green';

     }
   //Validar campo obligatorio
   if($direccion.length == 0){
        //document.getElementById("nombre").style.borderColor = "red"; 
        document.getElementById("direccion").style.boxShadow = ' inset 0 0 15px red'; 
        document.getElementById("direccion").placeholder = "Este campo es obligatorio";   
        return false;
    }else{
    	document.getElementById("direccion").style.boxShadow = 'inset 0 0 15px green';
    }

    //Validar campo obligatorio
    if($telefono.length == 0){
        //document.getElementById("nombre").style.borderColor = "red"; 
        document.getElementById("telefono").style.boxShadow = ' inset 0 0 15px red'; 
        document.getElementById("telefono").placeholder = "Este campo es obligatorio";   
        return false;
    }else{
    	document.getElementById("telefono").style.boxShadow = 'inset 0 0 15px green';
    }
    return true;
};

//***************************************************************************************************************

//Mascaras
$("#direccion").keypress(function(event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);     
});
function isValid(str) {
	return !/[~`!@$%\^&*()+=\-\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
}
$("#telefono").keypress(function(event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);     
});
function isValid(str) {
	return !/[~`!@#$%\^&*()+=e\\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
}



				//Aplicamos longitud maxima a los input

				$('#telefono').keydown(function(){
					$nombre=$('#telefono').val();
					if ($nombre.length<6){
						return true;
					}
					else {
						$('#telefono').val("");
						$('#telefono').attr("placeholder", "¡Caracteres max 9!");
						$('#telefono').css('box-shadow','inset 0 0 15px red');
					}
				});


				$('#direccion').keydown(function(){
					$nombre=$('#direccion').val();
					if ($nombre.length<40){
						return true;
					}
					else {
						$('#direccion').val("");
						$('#direccion').attr("placeholder", "¡Caracteres max 40!");
						$('#direccion').css('box-shadow','inset 0 0 15px red');
					}
				});

//*******************************************************************************************************************


	});	// Document ready


</script>