<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_home_controller extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('admin_home_model');
	}
	public function index()
	{
		$data= array (
			'title'	=> 'Bienvenido');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_home_view');
		$this->load->view('template/admin_footer');
		
	}
}
