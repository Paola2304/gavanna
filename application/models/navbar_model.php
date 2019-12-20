<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class navbar_model extends CI_Model {

//Mostrar
	public function get_rol(){
		$exe = $this->db->get('categoria');
		return $exe->result();
	}

}
