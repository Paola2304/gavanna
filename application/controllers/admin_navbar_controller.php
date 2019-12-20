<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_navbar_controller extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('admin_navbar_model');
	}
	
//Metodo para cerrar sesion y destruir la variable de sesion
	public function cerrar(){

		$user_data = array('Logueado' => FALSE);
		$this->session->set_userdata($user_data);
		$this->session->sess_destroy();
		redirect('perfil_controller','refresh');

	}

	//Actualizar contraseña
	public function change()
	{	
		$datos['clave'] = md5($this->input->post('pass2'));
		$datos['nueClave']= md5($this->input->post('passCp'));
		$datos['id'] = $this->session->userdata('id');
		$respuesta = $this->admin_navbar_model->change($datos);
		echo json_encode($respuesta);
	}

}
