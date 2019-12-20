<script type="text/javascript">
	$(document).ready(function(){

//FUNCION MOSTRAR PRODUCTO DETALLE

mostrarProductoDetalles();
function mostrarProductoDetalles(){

	$.ajax({

		type: 'ajax',
		url: '<?= base_url('admin_producto_detalle_controller/get_producto_detalle'); ?>',
		dataType: 'json',

		success: function(datos){
			var tabla= '';
			var i;
			var n=1;

			for(i=0; i<datos.length; i++){
				tabla+='<tr>'+
				'<td>'+n+'</td>'+
				'<td>'+datos[i].categoria+'</td>'+
				'<td>'+datos[i].nombre+'</td>'+
				'<td>'+datos[i].talla+'</td>'+
				'<td>'+datos[i].color+'</td>'+
				'<td>'+datos[i].cantidad+'</td>'+
				'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_producto_detalle+'">Eliminar</a>'+
				'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_producto_detalle+'">Editar</a>'+
				'</td>'+
				'</tr>';
				n++;

			}
			$('#tabla_productodetalle').html(tabla);
		}

	});

}//FIN FUNCION MOSTRAR PRODUCTOS DETALLES
//_______________________________________________________________________________________________________________________________


//RESTAURAR VISTA DE LA TABLA
$('#reload').click(function(){
	mostrarProductoDetalles();
});
//_______________________________________________________________________________________________________________________________

	//BUSCADOR
	$("#buscar").keypress(function(){

		$data = $("#buscar").val();

		$.ajax({

			type: 'ajax',
			method: 'post',
			url: '<?= base_url('admin_producto_detalle_controller/buscar') ?>',
			data: {palabra:$data},
			dataType: 'json',
			success: function(datos){
				var tabla='';
				var i;
				var n=1;

				for(i=0; i<datos.length;i++){
					tabla+='<tr>'+
					'<td>'+n+'</td>'+
					'<td>'+datos[i].categoria+'</td>'+
					'<td>'+datos[i].nombre+'</td>'+
					'<td>'+datos[i].talla+'</td>'+
					'<td>'+datos[i].color+'</td>'+
					'<td>'+datos[i].cantidad+'</td>'+
					'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_producto_detalle+'">Eliminar</a>'+
					'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_producto_detalle+'">Editar</a>'+
					'</td>'+
					'</tr>';
				}
				$('#tabla_productodetalle').html(tabla);
			},

		});
	});// FIN FUNCION BUSCAR

//_______________________________________________________________________________________________________________________________

//Funcion eliminar

$('#tabla_productodetalle').on('click','.borrar', function(){
	$id = $(this).attr('data');

	$('#modalBorrar').modal('show');

	$('#btnBorrar').unbind().click(function(){

		$.ajax({

			type: 'ajax',
			method: 'post',
			url: '<?= base_url('admin_producto_detalle_controller/eliminar')?>',
			data: {id:$id},
			dataType: 'json',

			success: function(respuesta){
				$('#modalBorrar').modal('hide');
				if (respuesta==true){
					alertify.notify('Eliminado exitosamente','success',10, null);
					mostrarProductoDetalles();
				}else{
					alertify.notify('Error al eliminar','error', 10, null);
				}
			}

		});
	});
});// FIN FUNCION BORRAR
//_______________________________________________________________________________________________________________________________

$('#nueDetail').click(function(){
	$('#id').val(0);
	$('#detalle').modal('show');
	$('#detalle').find('.modal-title').text('Nuevo Detalle');
	$('#detalle').find('.vinetaCantidad').text('Nuevo ingreso');
	$('#formDetalle').attr('action', '<?= base_url('admin_producto_detalle_controller/ingresar') ?>');
	$("#ocS1").show();
	$("#ocI1").hide();
	$("#ocS2").show();
	$("#ocI2").hide();
	$("#ocS3").show();
	$("#ocI3").hide();
	$("#ocS4").show();
	$("#ocI4").hide();
	restablecerInputs()

});


//$('#producto').attr('disabled');
//_______________________________________________________________________________________________________________________________
get_categoria();//llamado a la funcion para mostrar categoria

function get_categoria(){
			//Definimos que trabajaremos con ajax
			$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				//direccion hacia donde enviaremos la informacion (controlador/metodo)
				url: '<?= base_url('admin_producto_detalle_controller/get_categoria') ?>',
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
//_______________________________________________________________________________________________________________________________
//SELECT DE PRODUCTO
$('#categoria').change(function(){
	$id = $("#categoria").val();
	$('#producto').removeAttr("disabled");
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?= base_url('admin_producto_detalle_controller/get_producto') ?>',
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

//______________________________________________________________________________________________________________________________________
//Eventos change
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


//____________________________________________FUNCION PARA DESABILITAR EL ID_________________________________________________________
//function 




function existenciasP($producto,$talla,$color){
	$.ajax({

		type: 'ajax',
		method: 'post',
		url: '<?= base_url('admin_producto_detalle_controller/existencia')?>',
		data: {producto:$producto,talla:$talla,color:$color},
		dataType: 'json',

		success: function(respuesta){
			if (respuesta==0) {
				$('#exist').val('0');
				$('#registro').val('0');
				var vineta='';
				vineta+='<p style="font-size: 15px;margin-top: 2px">Producto en inventario: <b style="color:red">0</b></p>';
			}else{
				var vineta = '';
				var i;
				for(i=0; i<respuesta.length; i++){
					if (respuesta[i].cantidad>0 && respuesta[i].cantidad<=5) {
						vineta +='<p style="font-size: 15px;margin-top: 2px">Producto en inventario:  <b style="color:orange">'+respuesta[i].cantidad+'</b></p>';
					}else if(respuesta[i].cantidad>5){
						vineta +='<p style="font-size: 15px;margin-top: 2px">Producto en inventario:  <b style="color:green">'+respuesta[i].cantidad+'</b></p>';
					}else{
						vineta +='<p style="font-size: 15px;margin-top: 2px">Producto en inventario:  <b style="color:red">'+respuesta[i].cantidad+'</b></p>';
					}

					$('#exist').val(respuesta[i].cantidad);
					$('#registro').val('1');
				}
			}
			$('#vinetaInfo').html(vineta);
		}
	});
}

get_talla();
function get_talla(){
	$.ajax({

		type: 'ajax',
		url: '<?= base_url('admin_producto_detalle_controller/get_talla') ?>',
		dataType: 'json',

		success: function(datos){
			var op='';
			var i;
			op +="<option value=''>--Seleccione una opcion--</option>";

			for(i=0; i<datos.length; i++){
				op +="<option value='"+datos[i].id_talla+"'>"+datos[i].talla+"</option>";
			}
			$('#talla').html(op);
		}
	});
}// FIN FUNCION DE TALLAS

get_color();
function get_color(){
	$.ajax({

		type: 'ajax',
		url: '<?= base_url('admin_producto_detalle_controller/get_color') ?>',
		dataType: 'json',

		success: function(datos){
			var op='';
			var i;
			op +="<option value=''>--Seleccione una opcion--</option>";

			for(i=0; i<datos.length; i++){
				op +="<option value='"+datos[i].id_color+"'>"+datos[i].color+"</option>";
			}
			$('#color').html(op);
		}
	});
}// FIN FUNCION DE COLORES

//EVENTO MODAL GUARDAR

$('#btnGuardar').click(function(){

	var id= $('#id').val();

	$resp = validarFormulario(id);

	

	if($resp==true){

		$url = $('#formDetalle').attr('action');
		$data = $('#formDetalle').serialize();

		$.ajax({
			type: 'ajax',
			method: 'post',
			url: $url,
			data: $data,
			dataType: 'json',

			success: function(respuesta){
				$('#detalle').modal('hide');
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
	}else{
		return false;
	}

		});//fin evento del boton guardar del modal


//________________________________________________EDITAR_________________________________________________________________

$('#tabla_productodetalle').on('click', '.item-edit', function(){
	restablecerInputs();
	
	var id = $(this).attr('data');
	$('#detalle').find('.vinetaCantidad').text('Existencias inventario');
	//$('#categoria').removeAttr("disabled");
	$("#ocS1").hide();
	$("#ocI1").show();
	$("#ocS2").hide();
	$("#ocI2").show();
	$("#ocS3").hide();
	$("#ocI3").show();
	$("#ocS4").hide();
	$("#ocI4").show();
	$('#categoria').removeAttr("disabled");
	$('#producto').removeAttr("disabled");
	$('#color').removeAttr("disabled");
	$('#talla').removeAttr("disabled");
	$('#cantidad').removeAttr("disabled");

	$('#detalle').modal('show'); 
	$('#detalle').find('.modal-title').text('Editar Detalle');
	$('#formDetalle').attr('action','<?= base_url('admin_producto_detalle_controller/actualizar')?>');


	$.ajax({
				//tipo de solicitud a realizar
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_producto_detalle_controller/get_datos')?>',		
				data: {id:id},	

				dataType: 'json',

				success: function(datos){
					//en el input
					$('#id').val(datos.id_producto_detalle);
					$('#categoria1').val(datos.categoria);
					$('#producto2').val(datos.nombre);
					$('#talla3').val(datos.talla);
					$('#color4').val(datos.color);
					$('#cantidad').val(datos.cantidad);
				}
			});

});//fin de evento editar

//_________________________________________FIN DEL EDITAR_______________________________________________________________

function categ($id){
	$.ajax({
		type: 'ajax',
		method: 'post',
		url: '<?= base_url('admin_producto_detalle_controller/get_producto') ?>',
		data: {id:$id},
		async: 	false,
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
}
//_______________________________________________________________________________________________________________________________
//Limpiamos el formulario al clickear cerrar

$('#cerrar').click(function(){
	$('#formDetalle')[0].reset();
	$('#producto').attr('disabled','');
	$('#talla').attr('disabled','');
	$('#color').attr('disabled','');
	$('#cantidad').attr('disabled','');
	$('#vinetaInfo').hide();

});



/*__________________________________________VALIDACIONES__________________________________________________*/


function validarFormulario($id){

	$categoria      = $('#categoria option:selected').val();
	$producto      = $('#producto option:selected').val();
	$talla3 = $('#talla option:selected').val();
	$color4   = $('#color option:selected').val();
	$cantidad   = $('#cantidad').val();

	if ($id==0) {
    //Validar campo obligatorio
    if($categoria == 0){
        //document.getElementById("nombre").style.borderColor = "red"; 
        document.getElementById("categoria").style.boxShadow = 'inset 0 0 15px red'; 
        return false;
    }else{
    	document.getElementById("categoria").style.boxShadow = 'inset 0 0 15px green';
    }

    if($producto == 0){
    	document.getElementById("producto").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("producto").style.boxShadow = 'inset 0 0 15px green';
    }

    if($talla == 0){
    	document.getElementById("talla").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("talla").style.boxShadow = 'inset 0 0 15px green';
    }

    if($color == 0){
    	document.getElementById("color").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("color").style.boxShadow = 'inset 0 0 15px green';
    }

}
    //Validar input
    if($cantidad.length == 0){
    	document.getElementById("cantidad").style.boxShadow = 'inset 0 0 15px red';
    	document.getElementById("cantidad").placeholder = "Este campo es obligatorio";

    	return false;
    }else{
    	document.getElementById("cantidad").style.boxShadow = 'inset 0 0 15px green';
    	
    }
    return true;


};


$("#cantidad").keypress(function(event) {
	var character = String.fromCharCode(event.keyCode);
	return isValid(character);     
});
function isValid(str) {
	return !/[~`!@#$%\^&*()+=e\-\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
}

//___________________________________________RESTABLECER INPUTS_________________________________________________________________

		
		function restablecerInputs()
		{
			$('#categoria').css('box-shadow','none');
			$('#categoria').attr("placeholder", "");
			$('#producto').css('box-shadow','none');
			$('#producto').attr("placeholder", "");
			$('#talla').css('box-shadow','none');
			$('#talla').attr("placeholder", "");
			$('#color').css('box-shadow','none');
			$('#color').attr("placeholder", "");
			$('#cantidad').css('box-shadow','none');
			$('#cantidad').attr("placeholder", "");
			$(".alert").alert('close');
		}//FIN Funcion para limpiar inputs

//_______________________________________________________________________________________________________________________________

function enviar(){
  //var n =  document.getElementById("nombre").value;
  var datos={
  	"nombre": $("#nombre").val(),
  }

  $.ajax({
  	type:'post',
  	url: 'admin_producto_detalle_controller',
  	data: datos,
//data: {nombre:n},
success: function(d){
	$("#respa").html(d);
}

});
  return false;
}

});



//_______________________________________________________________________________________________________________________________


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

.sm{
	margin-bottom: 5px;
	margin-right: 10px;
	width: 50%;
	float: left;
}
</style>