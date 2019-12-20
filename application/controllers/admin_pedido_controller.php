<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_pedido_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_pedido_model');
	}
	public function index()
	{
		$data= array (
			'title' => 'CRUD || Pedido');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_pedido_view');
		$this->load->view('template/admin_footer');
	}


//Funciones mostrar
	public function get_pedido()
	{
		$respuesta= $this->admin_pedido_model->get_pedido();
		echo json_encode($respuesta);
	}

	public function get_categoria()
	{
		$id = $this->input->post('id');
		$respuesta= $this->admin_pedido_model->get_categoria();
		echo json_encode($respuesta);
	}
	public function get_producto()
	{	
		$id = $this->input->post('id');
		$respuesta= $this->admin_pedido_model->get_producto($id);
		echo json_encode($respuesta);
	}

	public function get_talla()
	{	
		$id = $this->input->post('id');
		$respuesta= $this->admin_pedido_model->get_talla($id);
		echo json_encode($respuesta);
	}

	public function get_color()
	{	
		$id = $this->input->post('id');
		$respuesta= $this->admin_pedido_model->get_color($id);
		echo json_encode($respuesta);
	}

	public function get_detalle()
	{	
		$id = $this->input->post('id');
		$respuesta= $this->admin_pedido_model->get_detalle($id);
		echo json_encode($respuesta);
	}

	public function get_usuario(){
		$respuesta = $this->admin_pedido_model->get_usuario();
		echo json_encode($respuesta);
	}

	public function get_estado_pedido(){
		$respuesta = $this->admin_pedido_model->get_estado_pedido();
		echo json_encode($respuesta);
	}

//Funcion buscar en tabla
	public function buscar()
	{
		$palabra = $this->input->post('palabra');
		$respuesta = $this->admin_pedido_model->buscar_palabra($palabra);
		echo json_encode($respuesta);
	}

	//funcion eliminar
	public function eliminar()
	{
		$id= $this->input->post('id');
		$respuesta= $this->admin_pedido_model->eliminar($id);
		echo json_encode($respuesta);
	}
//eliminar detalles
	public function eliminar2()
	{
		$id= $this->input->post('id');
		$respuesta= $this->admin_pedido_model->eliminar2($id);
		echo json_encode($respuesta);
	}

	//Funcion ingresar
	public function ingresar(){
		$datos['usuario'] = $this->input->post('usuario');
		date_default_timezone_set ( "America/El_Salvador" );
		$datos['fecha'] = $this->input->post('fecha');
		$datos['cargo_envio'] = $this->input->post('cargo_envio');
		$datos['estado'] = $this->input->post('estado');
		

		$respuesta = $this->admin_pedido_model->set_pedido($datos);
		echo json_encode($respuesta);
	}

	public function ingresarDetalle(){
		$registro = $this->input->post('registro');
		if($registro!=0){
			$exist = $this->input->post('exist');
			$existe = $this->input->post('existe');
			$datos['producto'] = $this->input->post('producto');
			$datos['talla']  = $this->input->post('talla');
			$datos['color']  = $this->input->post('color');
			$cantidadInput = $this->input->post('cantidad');

			/*$cantRes= $cantInput - $exist;
			$datos['cantidad'] = $cantRes;*/

			$cantidadResta=$exist -$cantidadInput;
			$datos['cantidad'] = $cantidadResta;

			$respuesta= $this->admin_pedido_model->set_cantidad($datos);
			echo json_encode($respuesta);
		
			$cantidadSuma= $exist +$cantidadInput;
			$datos['cantidad'] = $cantidadSuma;
			$respuesta= $this->admin_pedido_model->actualizarDetalle($datos);
			echo json_encode($respuesta);
			

		}else{
			$datos['producto'] =  $this->input->post('producto');
			$datos['talla'] =  $this->input->post('talla');
			$datos['color'] =  $this->input->post('color');
			$datos['cantidad'] =  $this->input->post('cantidad');
			$respuesta = $this->admin_pedido_model->set_detalle($datos);
			echo json_encode($respuesta);
		}
	}
	//PARA EL GUARDAR DE LA SUMATORIA EN EL CONTROLLER
	//FUNCIONES CONSULTAS 
	public function existencia(){
		$producto = $this->input->post('producto');
		$talla = $this->input->post('talla');
		$color = $this->input->post('color');
		$respuesta = $this->admin_pedido_model->existencia($producto,$talla,$color);
		echo json_encode($respuesta);
	}

	//Funciones actualizar

	public function get_datos(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_pedido_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){
		$datos['id']          = $this->input->post('id_pedido');
		$datos['usuario']     = $this->input->post('usuario');
		date_default_timezone_set ( "America/El_Salvador" );
		$datos['fecha']       = $this->input->post('fecha');
		$datos['cargo_envio'] = $this->input->post('cargo_envio');
		$datos['estado']      = $this->input->post('estado');

		$respuesta = $this->admin_pedido_model->actualizar($datos);

		echo json_encode($respuesta);
	}

	//Funciones actualizar

	public function get_datosDetalle(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_pedido_model->get_datosDetalle($id);
		echo json_encode($respuesta);
	}

	public function actualizarDetalle(){
		$datos['id']          = $this->input->post('id_pedido');
		$datos['cantidad']      = $this->input->post('cantidad');

		$respuesta = $this->admin_pedido_model->actualizarDetalle($datos);
		echo json_encode($respuesta);
	}

	//***************************************************************************************************



//**************************************************************************************


}
