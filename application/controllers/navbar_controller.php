<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class navbar_controller extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('navbar_model');
	}
	
//Mostrar
	public function get_categoria(){
		$respuesta = $this->navbar_model->get_rol();
		echo json_encode($respuesta);
	}
}
