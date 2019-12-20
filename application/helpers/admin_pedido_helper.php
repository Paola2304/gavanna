<script type="text/javascript">
	$(document).ready(function(){

//**************************************************************************************************************

		// FUNCION MOSTRAR
		mostrarPedido();
		function mostrarPedido(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('admin_pedido_controller/get_pedido'); ?>',
				dataType: 'json',

				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+' '+datos[i].apellido+'</td>'+
						'<td>'+datos[i].fecha+'</td>'+
						/*'<td>'+datos[i].subtotal+'</td>'+*/
						'<td>'+datos[i].cargo_envio+'</td>'+
						/*'<td>'+datos[i].monto_total+'</td>'+*/
						'<td>'+datos[i].estado+'</td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-warning btn-sm detalles" style="width: 100%" data="'+datos[i].id_pedido+'">Detalles</a></td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_pedido+'">Eliminar</a>'+
						'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_pedido+'">Editar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_pedido').html(tabla);
				}


			});
		}//FIN FUNCION MOSTRAR

//*********************************************************************************************************************************************


//Mostrar detalles pedido

$('#tabla_pedido').on('click','.detalles', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click

			
			mostrarDetalle();
			function mostrarDetalle(){
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_pedido_controller/get_detalle') ?>',
					data: {id:$id},
					dataType: 'json',

					success: function(datos){
						var tabla='';
						var i;
						var n=1;

						for(i=0; i<datos.length; i++){
							tabla+='<tr>'+
							'<td>'+n+'</td>'+
							'<td>'+datos[i].nombre+'</td>'+
							'<td>'+datos[i].talla+'</td>'+
							'<td>'+datos[i].color+'</td>'+
							'<td>'+datos[i].cantidad+'</td>'+
							'</tr>';
							n++;
						}
						$('#existencias').html(tabla);
					}


				});
		}//FIN FUNCION MOSTRAR



		});//Fin 


//******************************************************************************************
get_categoria();//llamado a la funcion para mostrar categoria

function get_categoria(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_pedido_controller/get_categoria') ?>',
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
					op +="<option value=''>--Seleccione una categoria--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option value='"+datos[i].id_categoria+"'>"+datos[i].categoria+"</option>";
					}
					//al select con el id sexo le entregamos la variable op que contiene los option
					$('#categoria').html(op);
				}
			});
		}//fin de funcion para mostrar categoria

		//******************************************************************************************
get_talla();//llamado a la funcion para mostrar categoria

function get_talla(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_pedido_controller/get_talla') ?>',
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
					op +="<option value=''>--Seleccione una talla--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option value='"+datos[i].id_talla+"'>"+datos[i].talla+"</option>";
					}
					//al select con el id sexo le entregamos la variable op que contiene los option
					$('#talla').html(op);
				}
			});
		}//fin de funcion para mostrar categoria


		//******************************************************************************************
get_color();//llamado a la funcion para mostrar categoria

function get_color(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_pedido_controller/get_color') ?>',
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
					op +="<option value=''>--Seleccione un color--</option>";
					//recorremos los datos recibidos, con datos.length obtenemos la longitud del arreglo
					//osea, numero de registros recibidos
					for(i=0; i<datos.length; i++){
						//en la variable op vamos guardando cada registro obtenido del modelo
						op +="<option value='"+datos[i].id_color+"'>"+datos[i].color+"</option>";
					}
					//al select con el id sexo le entregamos la variable op que contiene los option
					$('#color').html(op);
				}
			});
		}//fin de funcion para mostrar categoria
//*********************************************************************************
//sELECT DE PRODUCTO
$('#categoria').change(function(){
	$id = $("#categoria").val();
	$('#producto').removeAttr("disabled");
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?= base_url('admin_pedido_controller/get_producto') ?>',
		data: {id:$id},
		dataType: 'json',

		success: function(datos){		
			var op = '';
			var i;
			op +="<option value=''>--Seleccione un producto--</option>";
			for(i=0; i<datos.length; i++){
				op +="<option value='"+datos[i].id_producto+"'>"+datos[i].nombre+"</option>";
			}
			$('#producto').html(op);
		}
	});
});
 // change
 $('#producto').change(function(){
 	$('#talla').removeAttr("disabled");

 	$producto = $("#producto").val();
 	$talla = $("#talla").val();
 	$color = $("#color").val();

 	existenciasP($producto,$talla,$color);
 });

 $('#talla').change(function(){
 	$('#color').removeAttr("disabled");
 	$producto = $("#producto").val();
 	$talla = $("#talla").val();
 	$color = $("#color").val();

 	existenciasP($producto,$talla,$color);
 });

 $('#color').change(function(){
 	$('#cantidad').removeAttr("disabled");
 	$('#vinetaInfo').show();
 	$producto = $("#producto").val();
 	$talla = $("#talla").val();
 	$color = $("#color").val();

 	existenciasP($producto,$talla,$color);
 });
//**************************************************************************************************************


		//Restaurar vista tabla
		$('#reload').click(function(){
			mostrarPedido();
		});

//**************************************************************************************************************


		//Buscador
		$("#buscar").keypress(function(){
			$data = $("#buscar").val();

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_pedido_controller/buscar') ?>',
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
						'<td>'+datos[i].fecha+'</td>'+
/*						'<td>'+datos[i].subtotal+'</td>'+
*/						'<td>'+datos[i].cargo_envio+'</td>'+
/*						'<td>'+datos[i].monto_total+'</td>'+
*/						'<td>'+datos[i].estado+'</td>'+
'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_pedido+'">Eliminar</a>'+
'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_pedido+'">Editar</a>'+
'</td>'+
'</tr>';
}
$('#tabla_pedido').html(tabla);
},
});
		}); //Fin funcion buscar

//**************************************************************************************************************

$('#tabla_pedido').on('click','.borrar', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click

			$('#modalBorrar').modal('show'); //Para mostrar el modal de eliminar

			$('#btnBorrar').unbind().click(function(){ //Unbind sirve para que elimine cuando le de aceptar en el boton del modal
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_pedido_controller/eliminar') ?>',
					data: {id:$id},
					dataType: 'json',

					success: function(respuesta){
						 $('#modalBorrar').modal('hide');//Escondemos el modal de eliminar
						 if (respuesta==true) {
						 	alertify.notify('Eliminado exitosamente', 'success',10,null);
						 	mostrarPedido();
						 }else{
						 	alertify.notify('Error al eliminar', 'error',10,null);
						 }
						}
					});
			});

		});//Fin funcion borrar

//**************************************************************************************************************
//Detalles
$('#tabla_pedido').on('click','.detalles', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click

			$('#detallesModal').modal('show'); //Para mostrar el modal de eliminar

			

			

		});//Fin detalles

//**************************************************************************************************************



$('#nuePed').click(function(){
	$('#pedido').modal('show');
	$('#pedido').find('.modal-title').text('Nuevo pedido');
	$('#formPedido').attr('action','<?= base_url('admin_pedido_controller/ingresar')?>');
	restablecerInputs()


});

//**************************************************************************************************************

get_usuario();

function get_usuario(){

	$.ajax({
		type: 'ajax',
		url: '<?= base_url('admin_pedido_controller/get_usuario') ?>',
		dataType: 'json',

		success: function(datos){
			var op = '';
			var i;
			op +="<option value=''>--Seleccione un usuario--</option>";
			for(i=0; i<datos.length; i++){
				op +="<option value='"+datos[i].id_usuario+"'>"+datos[i].nombre+" "+datos[i].apellido+"</option>";
			}
			$('#usuario').html(op);
		}
	});
		} //fin de funcion para mostrar usuarios

//**************************************************************************************************************
$('#existencias').on('click','.borrar', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click

			$('#modalBorrar2').modal('show'); //Para mostrar el modal de eliminar

			$('#btnBorrar2').unbind().click(function(){ //Unbind sirve para que elimine cuando le de aceptar en el boton del modal
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_pedido_controller/eliminar2') ?>',
					data: {id:$id},
					dataType: 'json',

					success: function(respuesta){
						 $('#modalBorrar2').modal('hide');//Escondemos el modal de eliminar
						 if (respuesta==true) {
						 	alertify.notify('Eliminado exitosamente', 'success',10,null);
						 	mostrarDetalle();
						 }else{
						 	alertify.notify('Error al eliminar', 'error',10,null);
						 }
						}
					});
			});

		});//Fin funcion borrar
//**************************************************************************************************************

get_estado_pedido();//llamado a la funcion para mostrar el estado del pedido

function get_estado_pedido(){
	$.ajax({
		type: 'ajax',
		url: '<?= base_url('admin_pedido_controller/get_estado_pedido') ?>',
		dataType: 'json',
		success: function(datos){
			var op = '';
			var i;
			op +="<option value=''>--Seleccione un estado--</option>";
			for(i=0; i<datos.length; i++){
				op +="<option value='"+datos[i].id_estado+"'>"+datos[i].estado+"</option>";
			}
			$('#estado').html(op);
		}
	});
		} //fin de funcion para mostrar el estado de los pedidos
//**************************************************************************************************************


//agregamos un evento al boton del modal GUARDAR

$('#btnGuardar').click(function(){
	
	var id= $('#id').val();
	$resp=validarFormulario(id);

	$url = $('#formPedido').attr('action');
	$data = $('#formPedido').serialize();

	$.ajax({
		type: 'ajax',
		method: 'post',
		url: $url,
		data: $data,
		dataType: 'json',

		success: function(respuesta){
			$('#pedido').modal('hide');
			if(respuesta=='add'){
				alertify.notify('¡Ingresado exitosamente!', 'success',10, null);
			}else if(respuesta=='edi'){
				alertify.notify('¡Actualizado exitosamente!', 'success',10, null);
			}else if(respuesta== null){
				alertify.notify('¡No se ha realizado ningun cambio!', 'success',10, null);
			}else{
				alertify.notify('¡Error al ingresar!', 'error',10, null);
			}
			$('#formDetalle')[0].reset();
			mostrarProductoDetalles();
			



		}

	});

	});//fin evento del boton guardar del modal
//**********************************************************************************************************

$('#tabla_pedido').on('click', '.item-edit', function(){

	restablecerInputs();

	var id = $(this).attr('data');
			$('#pedido').modal('show');//Para mostrar el modal 
			$('#pedido').find('.modal-title').text('Editar pedido');
			$('#formPedido').attr('action','<?= base_url('admin_pedido_controller/actualizar')?>');

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_pedido_controller/get_datos')?>',
				data: {id:id},
				dataType: 'json',

				success: function(datos){
					$('#id').val(datos.id_pedido);
					$('#usuario').val(datos.id_usuario);
					$('#fecha').val(datos.fecha);
					//$('#subtotal').val(datos.subtotal);
					$('#cargo_envio').val(datos.cargo_envio);
					//$('#monto_total').val(datos.monto_total);
					$('#estado').val(datos.id_estado);
					

				}
			});
		});//fin de evento editar

		//Limpiamos el formulario al clickear cerrar
		$('#cerrar').click(function(){
			$('#formPedido')[0].reset();
		});

//____________________________________________________________________VALIDACIONES_________________________________________________________________________


function validarFormulario($id){

	$usuario      	= $('#usuario option:selected').val();
	$fecha      	= $('#fecha').val();
	//$subtotal 		= $('#subtotal').val();
	$cargo_envio   	= $('#cargo_envio').val();
	//$monto_total   	= $('#monto_total').val();
	$estado    		= $('#estado option:selected').val();

    //Validar campo obligatorio
    if($usuario == 0){
        //document.getElementById("nombre").style.borderColor = "red"; 
        document.getElementById("usuario").style.boxShadow = 'inset 0 0 15px red'; 
        return false;
    }else{
    	document.getElementById("usuario").style.boxShadow = 'inset 0 0 15px green';
    }

    if($fecha == 0){
    	document.getElementById("fecha").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("fecha").style.boxShadow = 'inset 0 0 15px green';
    }

    if($cargo_envio.length == 0){
    	document.getElementById("cargo_envio").style.boxShadow = 'inset 0 0 15px red'; 
    	document.getElementById("cargo_envio").placeholder = "Este campo es obligatorio";

    }else{
    	document.getElementById("cargo_envio").style.boxShadow = 'inset 0 0 15px green';
    }

    if($estado == 0){
    	document.getElementById("estado").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("estado").style.boxShadow = 'inset 0 0 15px green';
    }
    

/*if($subtotal.length == 0){
	document.getElementById("subtotal").style.boxShadow = 'inset 0 0 15px red'; 
	document.getElementById("subtotal").placeholder = "Este campo es obligatorio";

	return false;

}else{
	document.getElementById("subtotal").style.boxShadow = 'inset 0 0 15px green';

} */

/*if($monto_total.length == 0){
	document.getElementById("monto_total").style.boxShadow = 'inset 0 0 15px red'; 
	document.getElementById("monto_total").placeholder = "Este campo es obligatorio";

}else{
	document.getElementById("monto_total").style.boxShadow = 'inset 0 0 15px green';
}*/
return true;


};


/*$("#subtotal").keypress(function(event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);     
});
function isValid(str) {
	return !/[~`!@#$%\^&*()+=e\-\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
}*/

$("#cargo_envio").keypress(function(event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);     
});
function isValid(str) {
	return !/[~`!@#$%\^&*()+=e\-\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
}

/*$("#monto_total").keypress(function(event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);     
});
function isValid(str) {
	return !/[~`!@#$%\^&*()+=e\-\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
}*/
 //________________________________________________________FUNCION PARA LIMPIAR LOS INPUTS______________________________________________________



 function restablecerInputs()
 {
 	$('#usuario').css('box-shadow','none');
 	$('#usuario').attr("placeholder", "");
 	$('#fecha').css('box-shadow','none');
 	$('#fecha').attr("placeholder", "");
 	$('#cargo_envio').css('box-shadow','none');
 	$('#cargo_envio').attr("placeholder", "");
 	$('#estado').css('box-shadow','none');
 	$('#estado').attr("placeholder", "");
 	$(".alert").alert('close');
		}//FIN Funcion para limpiar inputs



//_________________________________________________________FIN VALIDACIONES___________________________________________________________________
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
.inputsTabla{
	float: left;
	widows: 70%;
}
.existTabla{
	float: right;
	widows: 30%;
}
.botones{
	float: right;
}
</style>