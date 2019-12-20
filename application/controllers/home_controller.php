<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home_controller extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('home_model');
	}
	public function index()
	{
		$data= array (
			'title'	=> 'Bienvenido');
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('home_view');
		$this->load->view('template/footer');
		
	}
}
