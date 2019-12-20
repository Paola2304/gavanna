<script type="text/javascript">
	$(document).ready(function(){

//**************************************************************************************************************

		// FUNCION MOSTRAR
		mostrarCategoria();
		function mostrarCategoria(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('admin_categoria_controller/get_categoria'); ?>',
				dataType: 'json',

				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].categoria+'</td>'+
						'<td>'+'<img data="'+datos[i].id_categoria+'" class="ima" src="<?= base_url();?>'+datos[i].portada+'"></td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_categoria+'">Eliminar</a>'+
						'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_categoria+'">Editar</a>'+'<input type="hidden" name="rutaN'+datos[i].id_categoria+'" id="rutaN'+datos[i].id_categoria+'" value="'+datos[i].portada+'">'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_categoria').html(tabla);
				}

			});
		}//FIN FUNCION MOSTRAR

//**************************************************************************************************************

//Mostrar imagen de tabla
$('#tabla_categoria').on('click','.ima', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click

			$('#modalImage').modal('show'); //Para mostrar el modal de image

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_categoria_controller/get_imagen') ?>',
				data: {id:$id},
				dataType: 'json',

				success: function(datos){
					var imagen='';
					var i;

					for(i=0;i<datos.length;i++){
						imagen+='<img class="ima2" src="<?= base_url();?>'+datos[i].portada+'">';
					}
					$('#imagen').html(imagen);
				}
			});

		});//Fin funcion borrar

//**************************************************************************************************************

		//Restaurar vista tabla
		$('#reload').click(function(){
			mostrarCategoria();
		});

//**************************************************************************************************************


		//Buscador
		$("#buscar").keypress(function(){
			$data = $("#buscar").val();

			$.ajax({
				type: 'ajax',
				method: 'post',
				url: '<?= base_url('admin_categoria_controller/buscar') ?>',
				data: {palabra:$data},
				dataType: 'json',
				success: function(datos){
					var tabla='';
					var i;
					var n=1;

					for(i=0;i<datos.length;i++){
						tabla+='<tr>'+
						'<td>'+n+'</td>'+
						'<td>'+datos[i].categoria+'</td>'+
						'<td>'+'<img data="'+datos[i].id_categoria+'" class="ima" src="<?= base_url();?>'+datos[i].portada+'"></td>'+
						'<td>'+'<a href="javascript:;" class="btn btn-danger btn-sm borrar" style="width: 50%" data="'+datos[i].id_categoria+'">Eliminar</a>'+
						'<a href="javascript:;" class="btn btn-info btn-sm item-edit" style="width: 50%" data="'+datos[i].id_categoria+'">Editar</a>'+'<input type="hidden" name="rutaN'+datos[i].id_categoria+'" id="rutaN'+datos[i].id_categoria+'" value="'+datos[i].portada+'">'+
						'</td>'+
						'</tr>';
						n++;
					}
					$('#tabla_categoria').html(tabla);
				},
			});
		}); //Fin funcion buscar

//**************************************************************************************************************
	//Borrar
	$('#tabla_categoria').on('click','.borrar', function(){
			$id = $(this).attr('data');//Para capturar el dato según el boton que demos click
			$rutaN = $('#rutaN'+$id).val();

			$('#modalBorrar').modal('show'); //Para mostrar el modal de eliminar

			$('#btnBorrar').unbind().click(function(){ //Unbind sirve para que elimine cuando le de aceptar en el boton del modal
				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_categoria_controller/eliminar') ?>',
					data: {id:$id,rutaN:$rutaN},
					dataType: 'json',

					success: function(respuesta){
						 $('#modalBorrar').modal('hide');//Escondemos el modal de eliminar
						 if (respuesta==true) {
						 	alertify.notify('Eliminado exitosamente', 'success',10,null);
						 	mostrarCategoria();
						 }else{
						 	alertify.notify('Error al eliminar', 'error',10,null);
						 }
						}
					});
			});

		});//Fin funcion borrar

//**************************************************************************************************************


		//Abrir modal para agregar nuevo registro
		$('#nueCat').click(function(){
			$('#imgPortada').hide();
			$('#id').val('0');
			//mostramos el modal que tiene el formulario para ingresar una categoria
			$('#categoria').modal('show');

			//modificamos el titulo del modal
			$('#categoria').find('.modal-title').text('Nueva categoria');
			//modificamos el atributo action, le agregamos la ruta del controlador y modelo para ingresar
			$('#formCategoria').attr('action','<?= base_url('admin_categoria_controller/ingresar')?>');
			restablecerInputs();
		});

//PARA TRABAJAR IMAGENES SE DEBE TRABAJAR SUBMIT PARA ENVIAR LA INFORMACION EN FORMATO DATA FORM
$('#formCategoria').on('submit',function(e){
	e.preventDefault();
	$id= $('#id').val();
	$res=validaciones($id);
	if ($res==true) {

		$url = $('#formCategoria').attr('action');

		$.ajax({
		//Respetar esta estructura para trabajar FormDta
		method: 'POST',
		url: $url,
		data: new FormData(this),
		cache: false,
		contentType: false, 
		processData:false,
		dataType: 'json',
		success: function(datas){
			$('#categoria').modal('hide');
			if(datas=='add'){
				alertify.notify('Ingresado exitosamente!', 'success',10, null);
			}else if(datas=='edi'){
				alertify.notify('Actualizado exitosamente!', 'success',10, null);
			}else{
				alertify.notify('error al ingresar!', 'error',10, null);
			}
			$('#formCategoria')[0].reset();
			mostrarCategoria();
		}
	});
	}

		});//fin evento del boton guardar del modal

//**************************************************************************************************************

			//EDITAR
			$('#tabla_categoria').on('click', '.item-edit', function(){
				restablecerInputs();
				var id = $(this).attr('data');
				$('#imgPortada').show();
				$('#categoria').modal('show');
				$('#categoria').find('.modal-title').text('Editar categoria');
				$('#formCategoria').attr('action','<?= base_url('admin_categoria_controller/actualizar')?>');

				$.ajax({
					type: 'ajax',
					method: 'post',
					url: '<?= base_url('admin_categoria_controller/get_datos')?>',
					data: {id:id},
					dataType: 'json',


					success: function(datos){
						$('#id').val(datos.id_categoria);
						$('#categoriaI').val(datos.categoria);
						$img='';
						$img+='<center><img style="width: 80%; height: 80%;" src="<?= base_url() ?>'+datos.portada+'"></center>'+
						'<input type="hidden" name="rutaN'+datos.id_categoria+'" id="rutaN'+datos.id_categoria+'" value="'+datos.portada+'">';
						$('#imgPortada').html($img);
					}
				});
		});//fin de evento editar


//**************************************************************************************************************


		//Limpiamos el formulario al clickear cerrar
		$('#cerrar').click(function(){
			$('#formCategoria')[0].reset();
			$('#imgPortada').hide();
		});


//**************************************************************************************************************

		//Funcion para limpiar inputs
		function restablecerInputs()
		{
			$('#categoriaI').css('box-shadow','none');
			$('#categoriaI').attr("placeholder", "");
			$(".alert").alert('close');
			$('#iconoFile').removeClass('text-success').addClass('text-secondary');
			$('#iconoFile').removeClass('fa-check').addClass('fa-file-upload');
		}//FIN Funcion para limpiar inputs


//**************************************************************************************************************
//VALIDACIONES

function validaciones($id){
				//Validacion Nombre
				$categoriaI= $('#categoriaI').val();
				if ($categoriaI.length==0) {
					$('#categoriaI').css('box-shadow','inset 0 0 15px red');
					$('#categoriaI').attr("placeholder", "Este campo es obligatorio");
					return	false;
				}else{
					$('#categoriaI').css('box-shadow','inset 0 0 15px green');
				}

				if ($id==0) {
				//Validacion file longitud
				if ($('#file').get(0).files.length === 0){
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Campo <strong>portada</strong> vacio, por favor carga una imagen!'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}
				}


				var fileInput = document.getElementById('file');
				var filePath = fileInput.value;
				if (filePath.length>0) {
				//Validacion file tipo

				var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
				if(!allowedExtensions.exec(filePath)){
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Formato no valido || Permitidos <strong>jpg, jpeg y png.</strong>'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}

				//Validacion file peso
				var limite_kb= 200;
				if($("#file")[0].files[0].size >=limite_kb * 1024){
					var msj='';
					msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Archivo sobrepasa los <strong>2 MB</strong>!'+
					'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
					'<span aria-hidden="true">&times;</span>'+
					'</button></div>';
					$('#mensajeAlerta').html(msj);
					return	false;
				}

				}


	//**************************************************
	return true;
}

//**************************************************************************************************************
				//Aplicamos longitud maxima a los input
				//categoriaI
				$('#categoriaI').keydown(function(){
					$categoriaI=$('#categoriaI').val();
					if ($categoriaI.length<30){
						return true;
					}
					else {
						$('#categoriaI').val("");
						$('#categoriaI').attr("placeholder", "¡Caracteres max 30!");
						$('#categoriaI').css('box-shadow','inset 0 0 15px red');
					}
				});

				//categoriaI evitamos caracteres especiales y numeros
				$("#categoriaI").keypress(function(event) {
					var character = String.fromCharCode(event.keyCode);
					return isValid(character);     
				});
				function isValid(str) {
					return !/[~`!@#$%\^&*()+=\-\[\]\';,/{}|\":<>\?0123456789.¿?¡]/g.test(str);
				}


				$('#file').change(function(){

					//Validacion file tipo
					var fileInput = document.getElementById('file');
					var filePath = fileInput.value;
					var allowedExtensions = /(.jpg|.jpeg|.png)$/i;
					if(!allowedExtensions.exec(filePath)){
						var msj='';
						msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Formato no valido || Permitidos <strong>jpg, jpeg y png.</strong>'+
						'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
						'<span aria-hidden="true">&times;</span>'+
						'</button></div>';
						$('#mensajeAlerta').html(msj);

						$('#iconoFile').removeClass('text-success').addClass('text-secondary');
						$('#iconoFile').removeClass('fa-check').addClass('fa-file-upload');
					}else{
					//Validacion file peso
					var limite_kb= 200;
					if($("#file")[0].files[0].size >=limite_kb * 1024){
						var msj='';
						msj+='<div class="alert alert-danger alert-dismissible fade show" role="alert">'+'Archivo sobrepasa los <strong>2 MB</strong>!'+
						'<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
						'<span aria-hidden="true">&times;</span>'+
						'</button></div>';
						$('#mensajeAlerta').html(msj);
						$('#iconoFile').removeClass('text-success').addClass('text-secondary');
						$('#iconoFile').removeClass('fa-check').addClass('fa-file-upload');
					}else{
						$(".alert").alert('close');
						$('#iconoFile').removeClass('text-secondary').addClass('text-success');
						$('#iconoFile').removeClass('fa-file-upload').addClass('fa-check');
					}
				}

				


			});


	});//Fin document ready
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

	.ima{
		width: 80px;
		border-radius: 5px;
		box-shadow: 0 1px 1px white;
	}

	.ima2{
		width: 100%;
	}

	
</style>