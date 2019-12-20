<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_categoria_model extends CI_Model {

	//Funciones mostrar
	public function get_categoria()
	{	
		
		$exe= $this->db->get('categoria');
		return $exe->result();
	}

	public function get_imagen($id)
	{	
		$this->db->where('id_categoria',$id);
		$exe= $this->db->get('categoria');
		return $exe->result();
	}

	//Funcion buscador de palabra
	public function buscar_palabra($palabra)
	{
		$this->db->select('id_categoria, categoria, portada');
		$this->db->from('categoria');
		$this->db->like('categoria',$palabra, 'both');
		$exe = $this->db->get();

		return $exe->result();
	}

	//funcion eliminar
	public function eliminar($id)
	{
		$this->db->where('id_categoria',$id);
		$this->db->delete('categoria');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	//Funcion ingresar
	public function set_categoria($datos){
		
		$this->db->set('categoria', $datos["categoria"]);
		$this->db->set('portada', $datos["portada"]);
		$this->db->insert('categoria');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}

	//Funciones actualizar
	public function get_datos($id){
		$this->db->where('id_categoria',$id);
		$exe = $this->db->get('categoria');

		if($exe->num_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}

	public function actualizar($datos){
		if ($datos["portada"]=='') {
			$this->db->set('categoria',$datos['categoria']);
			$this->db->where('id_categoria',$datos['id_categoria']);
			$this->db->update('categoria');

			if($this->db->affected_rows()>0){
				return "edi";
			}
		}else{
			$this->db->set('categoria',$datos['categoria']);
			$this->db->set('portada', $datos["portada"]);
			$this->db->where('id_categoria',$datos['id_categoria']);
			$this->db->update('categoria');

			if($this->db->affected_rows()>0){
				return "edi";
			}
		}
		
	}	

	
}
