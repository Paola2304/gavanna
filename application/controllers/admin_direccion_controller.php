<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_direccion_controller extends CI_Controller{

	public function __construct(){
		parent::__construct();
		$this->load->model('admin_direccion_model');	
	}

	public function index(){
		$data = array (
			'title' => 'CRUD || Direcciones');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_direccion_view');
		$this->load->view('template/admin_footer');
	}

	public function get_direccion(){
		$respuesta = $this->admin_direccion_model->get_direccion();
		echo json_encode($respuesta);
	}

	public function get_usuario(){
		$respuesta = $this->admin_direccion_model->get_usuario();
		echo json_encode($respuesta);
	}

	public function get_municipio(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_direccion_model->get_municipio($id);
		echo json_encode($respuesta);
	}

	public function get_departamento(){
		$respuesta = $this->admin_direccion_model->get_departamento();
		echo json_encode($respuesta);
	}

	public function buscar(){
		$data = $this->input->post("buscador");
		$resultado = $this->admin_direccion_model->set_busqueda($nombre);
		echo json_encode($resultado);
	}


	//Funcion de eliminar

	public function eliminar(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_direccion_model->eliminar($id);
		echo json_encode($respuesta);
	}

	//Funcion ingresar
	public function ingresar(){
		$datos['nombre'] = $this->input->post('nombre');
		$datos['municipio'] = $this->input->post('municipio');
		$datos['departamento'] = $this->input->post('departamento');
		$datos['direccion'] = $this->input->post('direccion');
		$datos['telefono'] = $this->input->post('telefono');

		$respuesta = $this->admin_direccion_model->set_direccion($datos);
		echo json_encode($respuesta);
	}//Fin funcion ingresar

	public function get_datos(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_direccion_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){
		$datos['id_direccion'] = $this->input->post('id_direccion');
		$datos['nombre'] = $this->input->post('id_usuario');
		$datos['municipio'] = $this->input->post('municipio');
		$datos['departamento'] = $this->input->post('departamento');
		$datos['direccion'] = $this->input->post('direccion');
		$datos['telefono'] = $this->input->post('telefono');

		$respuesta = $this->admin_direccion_model->actualizar($datos);
		echo json_encode($respuesta);
	}
}