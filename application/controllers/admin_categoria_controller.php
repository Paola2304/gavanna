<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_categoria_controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin_categoria_model');
	}
	public function index()
	{
		$data= array (
			'title' => 'CRUD || Categoria');
		$this->load->view('template/admin_header',$data);
		$this->load->view('template/admin_navbar');
		$this->load->view('admin_categoria_view');
		$this->load->view('template/admin_footer');
	}

	//Funciones mostrar
	public function get_categoria()
	{
		$respuesta= $this->admin_categoria_model->get_categoria();
		echo json_encode($respuesta);
	}

	public function get_imagen()
	{
		$id = $this->input->post('id');
		$respuesta= $this->admin_categoria_model->get_imagen($id);
		echo json_encode($respuesta);
	}

	//Funcion buscar en tabla
	public function buscar()
	{
		$palabra = $this->input->post('palabra');
		$respuesta = $this->admin_categoria_model->buscar_palabra($palabra);
		echo json_encode($respuesta);
	}

	//funcion eliminar
	public function eliminar()
	{
		$id= $this->input->post('id');
		$rutaN= $this->input->post('rutaN');
		unlink($rutaN);
		$respuesta= $this->admin_categoria_model->eliminar($id);
		echo json_encode($respuesta);
	}

	//Funcion ingresar
	public function ingresar(){
		if (isset($_FILES["file"]["name"])) {
			$config['upload_path'] = "props/ropa/categoria/";
			$config['allowed_types'] = "png|jpg|jpeg";
			$this->load->library('upload',$config);

			if (!$this->upload->do_upload('file')) {
				echo $this->upload->display_errors();
			}else{
				$data = $this->upload->data();
				$datos['categoria'] = $this->input->post('categoriaI');
				$datos['portada']="props/ropa/categoria/".$data["file_name"];
				$datas = $this->admin_categoria_model->set_categoria($datos);
				echo json_encode($datas);
			}
		}
	}

//Funcion actualizar
	public function get_datos(){
		$id = $this->input->post('id');
		$respuesta = $this->admin_categoria_model->get_datos($id);
		echo json_encode($respuesta);
	}

	public function actualizar(){
		if ($_FILES["file"]["name"]!='') {

			$config['upload_path'] = "props/ropa/categoria/";
			$config['allowed_types'] = "png|jpg|jpeg";
			$this->load->library('upload',$config);

			if (!$this->upload->do_upload('file')) {
				echo $this->upload->display_errors();
			}else{
				$data = $this->upload->data();
				$datos['id_categoria'] = $this->input->post('id_categoria');
				$datos['categoria']    = $this->input->post('categoriaI');
				$datos['portada']="props/ropa/categoria/".$data["file_name"];
				$id=$this->input->post('id_categoria');
				$palabra='rutaN'.$id;
				$rutaN= $this->input->post($palabra);
				unlink($rutaN);
				$datas = $this->admin_categoria_model->actualizar($datos);
				echo json_encode($datas);
			}
		}else{
			$datos['id_categoria'] = $this->input->post('id_categoria');
			$datos['categoria']    = $this->input->post('categoriaI');
			$datos['portada']='';
			$datas = $this->admin_categoria_model->actualizar($datos);
			echo json_encode($datas);
		}
	}

}
