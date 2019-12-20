<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_producto_detalle_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_producto_detalle_model');
	}
	public function index()
	{
		$data= array (
			'title' => 'CRUD || ProductosDetalles');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_producto_detalle_view');
		$this->load->view('template/admin_footer');
	}

	//Funciones mostrar
	public function get_producto_detalle(){
		$respuesta= $this->admin_producto_detalle_model->get_producto_detalle();
		echo json_encode($respuesta);
	}
	public function get_producto(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_producto_detalle_model->get_producto($id);
		echo json_encode($respuesta);
	}
	
	public function get_talla(){
		$respuesta = $this->admin_producto_detalle_model->get_talla();
		echo json_encode($respuesta);
	}
	public function get_color(){
		$respuesta = $this->admin_producto_detalle_model->get_color();
		echo json_encode($respuesta);
	}
	public function get_categoria(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_producto_detalle_model->get_categoria();
		echo json_encode($respuesta);
	}
	//Funcion buscar en tabla
	public function buscar()
	{
		$palabra = $this->input->post('palabra');
		$respuesta = $this->admin_producto_detalle_model->buscar_palabra($palabra);
		echo json_encode($respuesta);
	}

	//FUNCION ELIMINAR
	public function eliminar(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_producto_detalle_model->eliminar($id);
		echo json_encode($respuesta);
	}

	//FUNCION INGRESAR
	public function ingresar(){
		$registro  = $this->input->post('registro');
		if ($registro!=0) {
			$exist  = $this->input->post('exist');
			$datos['producto']  = $this->input->post('producto');
			$datos['talla']  = $this->input->post('talla');
			$datos['color']  = $this->input->post('color');
			$cantidadInput= $this->input->post('cantidad');
			
			$cantidadSum=$exist +$cantidadInput;
			$datos['cantidad']  = $cantidadSum;

			$respuesta = $this->admin_producto_detalle_model->set_cantidad($datos);
			echo json_encode($respuesta);
		}else{
			$datos['producto']  = $this->input->post('producto');
			$datos['talla']  = $this->input->post('talla');
			$datos['color']  = $this->input->post('color');
			$datos['cantidad']  = $this->input->post('cantidad');
			$respuesta = $this->admin_producto_detalle_model->set_detalle($datos);
			echo json_encode($respuesta);
		}
	}


	//FUNCIONES CONSULTAS 
	public function existencia(){
		$producto = $this->input->post('producto');
		$talla = $this->input->post('talla');
		$color = $this->input->post('color');
		$respuesta = $this->admin_producto_detalle_model->existencia($producto,$talla,$color);
		echo json_encode($respuesta);
	}


	//FUNCIONES ACTUALIZAR
	public function get_datos(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_producto_detalle_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){
		$datos['id']          = $this->input->post('id_producto_detalle');
		$datos['cantidad']    = $this->input->post('cantidad');

		$respuesta = $this->admin_producto_detalle_model->actualizar($datos);

		echo json_encode($respuesta);
	}




	/*public function get_imagen()
	{
		$id = $this->input->post('id');
		$respuesta= $this->admin_categoria_model->get_imagen($id);
		echo json_encode($respuesta);
	}*/

}


?>