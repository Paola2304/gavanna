<script type="text/javascript">
	$(document).ready(function(){

		// FUNCION MOSTRAR
		mostrarProducto();
		function mostrarProducto(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('admin_producto_controller/get_producto'); ?>',
				dataType: 'json',

				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+'</td>'+
						'<td>'+datos[i].precio+'</td>'+
						'<td>'+datos[i].descripcion+'</td>'+
						'<td>'+datos[i].categoria+'</td>'+
						'<td><a style="width:100%;" href="javascript:;" class="btn btn-warning btn-sm galeria" data="'+datos[i].id_producto+'">Galeria</a></td>'+
						'<td>'+'<a style="width:50%;" href="javascript:;" class="btn btn-danger btn-sm borrar" data="'+datos[i].id_producto+'">Eliminar</a>'+
						'<a style="width:50%;" href="javascript:;" class="btn btn-info btn-sm item-edit" data="'+datos[i].id_producto+'">Editar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_producto').html(tabla);
				}
			});
		}
        // fin función mostrar
//__________________________________________________________________________________________________________

		//Restaurar vista tabla
		$('#reload').click(function(){
			mostrarProducto();
		});

//__________________________________________________________________________________________________________

		//Buscador
		$("#buscar").keypress(function(){
			$data = $("#buscar").val();

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_producto_controller/buscar') ?>',
				data: {palabra:$data},
				dataType: 'json',
				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].nombre+'</td>'+
						'<td>'+datos[i].precio+'</td>'+
						'<td>'+datos[i].descripcion+'</td>'+
						'<td>'+datos[i].categoria+'</td>'+
						'<td><a style="width:100%;" href="javascript:;" class="btn btn-warning btn-sm galeria" data="'+datos[i].id_producto+'">Galeria</a></td>'+
						'<td>'+'<a style="width:50%;" href="javascript:;" class="btn btn-danger btn-sm borrar" data="'+datos[i].id_producto+'">Eliminar</a>'+
						'<a style="width:50%;" href="javascript:;" class="btn btn-info btn-sm item-edit" data="'+datos[i].id_producto+'">Editar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_producto').html(tabla);
				},

			});
		}); //Fin funcion buscar

//______________________________________________________________________________________________________________

         //funcion eliminar
         $('#tabla_producto').on('click','.borrar', function(){
         	$id = $(this).attr('data');
         	$('#modalBorrar').modal('show'); 
         	$('#btnBorrar').unbind().click(function(){ 
         		$.ajax({
         			type: 'ajax',
         			method: 'post',
         			url: '<?= base_url('admin_producto_controller/eliminar') ?>',
         			data: {id:$id},
         			dataType: 'json',

         			success: function(respuesta){
         				$('#modalBorrar').modal('hide');
         				if (respuesta==true) {
         					alertify.notify('Eliminado exitosamente!', 'success',10,null);
         					mostrarProducto();
         				}else{
         					alertify.notify('Error al eliminar!', 'error',10,null);
         				}
         			}
         		});
         	});

		});//Fin funcion eliminar

//___________________________________________________________________________________________________________
		//modificamos el titulo del modal
		$('#nuePro').click(function(){
			$('#producto').modal('show');
			$('#producto').find('.modal-title').text('Nuevo Producto');
			$('#formProducto').attr('action','<?= base_url('admin_producto_controller/ingresar')?>');
		});

//___________________________________________________________________________________________________________

	//llamado a la funcion para mostrar categoria
	get_categoria();
	function get_categoria(){
		$.ajax({
			type: 'ajax',
			url: '<?= base_url('admin_producto_controller/get_categoria') ?>',
			dataType: 'json',

			success: function(datos){
				var op = '';
				var i;

				op +="<option value=''>--Seleccione una categoria--</option>";
				for(i=0; i<datos.length; i++){
					op +="<option value='"+datos[i].id_categoria+"'>"+datos[i].categoria+"</option>";
				}
				$('#categoria').html(op);
			}
		});
		}//fin de funcion para mostrar categoria
//__________________________________________________________________________________________________________


     //agregamos un evento al boton del modal GUARDAR
     $('#btnGuardar').click(function(){
     	$resp=validarFormulario();

     	if($resp == true){
     		$url = $('#formProducto').attr('action');
     		$data = $('#formProducto').serialize();

     		$.ajax({

     			type: 'ajax',
     			method: 'post',
     			url: $url,
     			data: $data,
     			dataType: 'json',


     			success: function(respuesta){
     				$('#producto').modal('hide');
     				if(respuesta=='add'){

     					alertify.notify('Ingresado exitosamente!', 'success',10, null);
     				}else if(respuesta=='edi'){

     					alertify.notify('Actualizado exitosamente!', 'success',10, null);
     				}else{

     					alertify.notify('error al ingresar!', 'error',10, null);
     				}

     				$('#formProducto')[0].reset();

     				mostrarProducto();
     			}
     		});
     	}
		});//fin evento del boton guardar del modal
//____________________________________________________________________________________________________________		
		// boton  editar 
		$('#tabla_producto').on('click', '.item-edit', function(){
			var id = $(this).attr('data');

			$('#producto').modal('show');//Para mostrar el modal 		
			$('#producto').find('.modal-title').text('Editar Producto');
			$('#formProducto').attr('action','<?= base_url('admin_producto_controller/actualizar') ?>');

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_producto_controller/get_datos')?>',
				data: {id:id},
				dataType: 'json',

				success: function(datos){
					$('#id').val(datos.id_producto);
					$('#nombre').val(datos.nombre);
					$('#precio').val(datos.precio);
					$('#descripcion').val(datos.descripcion);
					$('#categoria').val(datos.id_categoria);
				}
			});
		});//fin de editar



//_________________________________________________________________________________________________________

		//Limpiamos el formulario al cerrar
		$('#cerrar').click(function(){
			$('#formProducto')[0].reset();
		});

//______________________________________________________________________________________________________________
         
         $('#tabla_producto').on('click','.galeria', function(){
         	$id = $(this).attr('data');
         	$('#modalGaleria').modal('show'); 
         	$('#productoI').val($id);
			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_producto_controller/get_imagen') ?>',
				data: {id:$id},
				dataType: 'json',

				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+'<img style="width:80px;border-radius:5px;" src="<?= base_url() ?>'+datos[i].imagen+'">'+'</td>'+
						'<td>'+'<a style="width:50%;" href="javascript:;" class="btn btn-danger btn-sm borrarI" data="'+datos[i].id_imagen+'">Eliminar</a>'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_imagen').html(tabla);
				}


			});

		});//Fin

//______________________________________________________________________________________________________________ Imagen

         //funcion eliminar
         $('#tabla_producto').on('click','.borrarI', function(){
         	$id = $(this).attr('data');
         	$idProducto= $('#id_productoI').val();
         	$('#modalBorrar').modal('show'); 
         	$('#btnBorrar').unbind().click(function(){ 
         		$.ajax({
         			type: 'ajax',
         			method: 'post',
         			url: '<?= base_url('admin_producto_controller/eliminarI') ?>',
         			data: {id:$id, idProducto:$idProducto},
         			dataType: 'json',

         			success: function(respuesta){
         				$('#modalBorrar').modal('hide');
         				if (respuesta==true) {
         					alertify.notify('Eliminado exitosamente!', 'success',10,null);
         					mostrarProducto();
         				}else{
         					alertify.notify('Error al eliminar!', 'error',10,null);
         				}
         			}
         		});
         	});

		});//Fin funcion eliminar

//_________________________________________________________________________________________________________

//VALIDACIONES

function validarFormulario(){

	$nombre      = $('#nombre').val();
	$precio      = $('#precio').val();
	$descripcion = $('#descripcion').val();
	$categoria   = $('#categoria option:selected').val();


    //Validar campo obligatorio
    if($nombre.length == 0){
        //document.getElementById("nombre").style.borderColor = "red"; 
        document.getElementById("nombre").style.boxShadow = ' inset 0 0 15px red'; 
        document.getElementById("nombre").placeholder = "Este campo es obligatorio";   
        return false;
    }else{
    	document.getElementById("nombre").style.boxShadow = 'inset 0 0 15px green';
    }

    //Validar campo obligatorio
    if($precio.length == 0){
    	document.getElementById("precio").style.boxShadow = 'inset 0 0 15px red'; 
    	document.getElementById("precio").placeholder = "Este campo es obligatorio";
    	return false;
    }else{
    	document.getElementById("precio").style.boxShadow = ' inset 0 0 15px green';
    }

    if($descripcion.length == 0){
    	document.getElementById("descripcion").style.boxShadow = 'inset 0 0 15px red'; 
    	document.getElementById("descripcion").placeholder = "Este campo es obligatorio";
    	return false;
    }else{
    	document.getElementById("descripcion").style.boxShadow = 'inset 0 0 15px green';
    }
    //Validar comboBox
    if($categoria == 0){
    	document.getElementById("categoria").style.boxShadow = 'inset 0 0 15px red'; 
    	return false;
    }else{
    	document.getElementById("categoria").style.boxShadow =  'inset 0 0 15px green';
    	
    }
   return true;
};


//Mascaras
				$("#nombre").keypress(function(event) {
					var character = String.fromCharCode(event.keyCode);
					return isValid(character);     
				});
				function isValid(str) {
					return !/[~`´´!@#$%\^&*()+=\-\[\]\';,/{}|\":<>\?.¿?¡]/g.test(str);
				}

				$("#descripcion").keypress(function(event) {
					var character = String.fromCharCode(event.keyCode);
					return isValid(character);     
				});
				function isValid(str) {
					return !/[~`!@#$%\^&*()+=\-\[\]\';/{}|\":<>\?.¿?¡]/g.test(str);
				}
				$("#precio").keypress(function(event) {
					var character = String.fromCharCode(event.keyCode);
					return isValid(character);     
				});
				function isValid(str) {
					return !/[~`!@#$%\^&*()+=e\-\[\]\';/{}|\":<>\?¿?¡]/g.test(str);
				}



				//Aplicamos longitud maxima a los input

				$('#nombre').keydown(function(){
					$nombre=$('#nombre').val();
					if ($nombre.length<30){
						return true;
					}
					else {
						$('#nombre').val("");
						$('#nombre').attr("placeholder", "¡Caracteres max 30!");
						$('#nombre').css('box-shadow','inset 0 0 15px red');
					}
				});

				$('#precio').keydown(function(){
					$nombre=$('#precio').val();
					if ($nombre.length<6){
						return true;
					}
					else {
						$('#precio').val("");
						$('#precio').attr("placeholder", "¡Caracteres max 6!");
						$('#precio').css('box-shadow','inset 0 0 15px red');
					}
				});


				$('#descripcion').keydown(function(){
					$nombre=$('#descripcion').val();
					if ($nombre.length<40){
						return true;
					}
					else {
						$('#descripcion').val("");
						$('#descripcion').attr("placeholder", "¡Caracteres max 40!");
						$('#descripcion').css('box-shadow','inset 0 0 15px red');
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