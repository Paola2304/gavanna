<script type="text/javascript">
	$(document).ready(function(){
		get_categoria();

		function get_categoria(){
			$.ajax({
				type: 'ajax',
				url: '<?= base_url('navbar_controller/get_categoria') ?>',
				dataType: 'json',

				success: function(datos){
					var op = '';
					var i;
					for(i=0; i<datos.length; i++){
						op +='<a class="dropdown-item op" href="#"  value="'+datos[i].id_categoria+'">'+datos[i].categoria+'</a>';
					}
					$('#categoriasSelect').html(op);
				}
			});
		}
	});
	

</script>