<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perfil_model extends CI_Model {

	//Funcion validar usuario para iniciar sesion
	public function validar($datos){
		//validamos que el correo y la clave enviada pertenezcan al usuario
		$this->db->select('id_usuario,nombre, apellido, id_rol');
		$this->db->from('usuario');
		$this->db->where('correo',$datos['correo']);
		$this->db->where('contrasenia',$datos['clave']);
		$exe = $this->db->get();
		
		return $exe->row();
		
		
	}

	//Funcion para verificar correo en base de datos
	public function get_correo($correo)
	{
		$this->db->select('id_usuario,correo,nombre,apellido');
		$this->db->where('correo',$correo);
		$exe= $this->db->get('usuario');

		return $exe->result();
	}
	// Actualizar contraseña mediante correo
	public function act_pass($pass,$id)
	{
		$this->db->set('contrasenia', $pass);
		$this->db->where('id_usuario', $id);
		$this->db->update('usuario');
	}

	// Ingresar registro
	public function registrar($datos)
	{
		$this->db->set('nombre', $datos['nombre']);
		$this->db->set('apellido', $datos['apellido']);
		$this->db->set('correo', $datos['correo']);
		$this->db->set('contrasenia', $datos['clave']);
		$this->db->set('id_rol', $datos['rol']);
		$this->db->insert('usuario');
	}

	//CONSULTAS
	public function validarCorreo($correo)
	{
		$this->db->where('correo',$correo);
		$this->db->get('usuario');

		if($this->db->affected_rows() > 0 ){
			return true;
		}else{
			return false;
		}
	}

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
