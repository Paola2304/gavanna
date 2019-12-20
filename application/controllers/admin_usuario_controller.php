<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_usuario_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_usuario_model');
	}
	public function index()
	{
		$data= array (
			'title' => 'CRUD || Usuario');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_usuario_view');
		$this->load->view('template/admin_footer');
	}


//Funciones mostrar
	public function get_usuario()
	{
		$respuesta= $this->admin_usuario_model->get_usuario();
		echo json_encode($respuesta);
	}

	public function get_rol(){
		$respuesta = $this->admin_usuario_model->get_rol();
		echo json_encode($respuesta);
	}

//Funcion buscar en tabla
	public function buscar()
	{
		$palabra = $this->input->post('palabra');
		$respuesta = $this->admin_usuario_model->buscar_palabra($palabra);
		echo json_encode($respuesta);
	}

	//funcion eliminar
	public function eliminar()
	{
		$id= $this->input->post('id');
		$respuesta= $this->admin_usuario_model->eliminar($id);
		echo json_encode($respuesta);
	}

	//Funcion ingresar
	public function ingresar(){
		$datos['nombre'] = $this->input->post('nombre');
		$datos['apellido'] = $this->input->post('apellido');
		$datos['correo'] = $this->input->post('correo');
		$datos['rol'] = $this->input->post('rol');
		$pass= md5($this->input->post('pass'));
		$datos['pass'] = $pass;

		$respuesta = $this->admin_usuario_model->set_usuario($datos);
		echo json_encode($respuesta);
	}

	//Funciones actualizar

	public function get_datos(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_usuario_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){
		$datos['id_usuario'] = $this->input->post('id_usuario');
		$datos['nombre']    = $this->input->post('nombre');
		$datos['apellido']  = $this->input->post('apellido');
		$datos['correo']      = $this->input->post('correo');
		$datos['rol']     = $this->input->post('rol');

		$respuesta = $this->admin_usuario_model->actualizar($datos);

		echo json_encode($respuesta);
	}

	//CONSULTAS
	public function validarCorreo()
	{	
		$correo = $this->input->post('correo');
		$respuesta = $this->admin_usuario_model->validarCorreo($correo);
		echo json_encode($respuesta);
	}

}
