<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_producto_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_producto_model');
	}
	public function index()
	{
		$data= array (
			'title' => 'CRUD || Producto');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_producto_view');
		$this->load->view('template/admin_footer');
	}
// mostrar
	public function get_producto()
	{
		$respuesta= $this->admin_producto_model->get_producto();
		echo json_encode($respuesta);
	}
	public function get_categoria(){
		$respuesta = $this->admin_producto_model->get_categoria();
		echo json_encode($respuesta);
	}

	public function get_imagen(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_producto_model->get_imagen($id);
		echo json_encode($respuesta);
	}

//Funcion buscar en tabla
	public function buscar()
	{
		$palabra = $this->input->post('palabra');
		$respuesta = $this->admin_producto_model->buscar_palabra($palabra);
		echo json_encode($respuesta);
	}

//funcion eliminar
	public function eliminar()
	{
		$id= $this->input->post('id');
		$respuesta= $this->admin_producto_model->eliminar($id);
		echo json_encode($respuesta);
	}

	public function eliminarI()
	{
		$datos['id'] = $this->input->post('id');
		$datos['idProducto'] = $this->input->post('idProducto');
		$respuesta= $this->admin_producto_model->eliminarI($datos);
		echo json_encode($respuesta);
	}

//Funcion ingresar
	public function ingresar(){
		
				$datos['nombre'] = $this->input->post('nombre');
				$datos['precio'] = $this->input->post('precio');
				$datos['descripcion'] = $this->input->post('descripcion');
				$datos['categoria'] = $this->input->post('categoria');
				$datos['talla'] = $this->input->post('talla');
				$datos['categoria'] = $this->input->post('categoria');
				$respuesta = $this->admin_producto_model->set_producto($datos);
				echo json_encode($respuesta);
			}

//Funciones actualizar

	public function get_datos(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_producto_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){
		
			$datos['id_producto'] = $this->input->post('id_producto');
			$datos['nombre']    = $this->input->post('nombre');
			$datos['precio']  = $this->input->post('precio');
			$datos['descripcion']      = $this->input->post('descripcion');
			$datos['categoria']     = $this->input->post('categoria');
			$datos['talla'] = $this->input->post('talla');
			$datos['categoria'] = $this->input->post('categoria');
			

			$respuesta = $this->admin_producto_model->actualizar($datos);

			echo json_encode($respuesta);
		
	}
}

