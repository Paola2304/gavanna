<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_navbar_model extends CI_Model {

	//Cambiar contraseñas
	public function change($datos)
	{
		$this->db->where('id_usuario', $datos['id']);
		$this->db->where('contrasenia', $datos['clave']);
		$this->db->set('contrasenia', $datos['nueClave']);
		$this->db->update('usuario');

		if($this->db->affected_rows() > 0 ){
			return 'Exito';
		}else{
			return 'Error';
		}
	}
	
}
