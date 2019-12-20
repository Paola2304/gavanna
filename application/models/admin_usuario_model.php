<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_usuario_model extends CI_Model {

	//Funciones mostrar
	public function get_usuario()
	{	
		$this->db->select('u.id_usuario, u.nombre, u.apellido, u.correo, u.id_rol,r.rol');
		$this->db->from('usuario u');
		$this->db->join('rol r','u.id_rol=r.id_rol');
		$exe= $this->db->get();
		return $exe->result();
	}

	public function get_rol(){
		$exe = $this->db->get('rol');
		return $exe->result();
	}

	//Funcion buscador de palabra
	public function buscar_palabra($palabra)
	{
		$this->db->select('u.id_usuario, u.nombre, u.apellido, u.correo, u.id_rol,r.rol');
		$this->db->from('usuario u');
		$this->db->join('rol r','u.id_rol=r.id_rol');
		//AGREGAR LAS BUSQUEDAS SEGUN FILTROS NECESARIOS
		$this->db->like('nombre',$palabra, 'both');
		$this->db->or_like('apellido',$palabra, 'both');
		$this->db->or_like('correo',$palabra, 'both');
		$this->db->or_like('rol',$palabra, 'both');
		$exe = $this->db->get();

		return $exe->result();
	}
	//funcion eliminar
	public function eliminar($id)
	{
		$this->db->where('id_usuario',$id);
		$this->db->delete('usuario');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	//Funcion ingresar
	public function set_usuario($datos){
		
		$this->db->set('nombre', $datos["nombre"]);
		$this->db->set('apellido', $datos["apellido"]);
		$this->db->set('correo', $datos["correo"]);
		$this->db->set('contrasenia', $datos["pass"]);
		$this->db->set('id_rol', $datos["rol"]);
		
		$this->db->insert('usuario');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}

	//Funciones actualizar
	public function get_datos($id){
		$this->db->where('id_usuario',$id);
		$exe = $this->db->get('usuario');

		if($exe->num_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}


	public function actualizar($datos){
		$this->db->set('nombre',$datos['nombre']);
		$this->db->set('apellido',$datos['apellido']);
		$this->db->set('correo',$datos['correo']);
		$this->db->set('id_rol',$datos['rol']);
		$this->db->where('id_usuario',$datos['id_usuario']);
		$this->db->update('usuario');

		if($this->db->affected_rows()>0){
			return "edi";
		}
	}

	//CONSULTAS
	public function validarCorreo($correo)
	{
		$this->db->where('correo',$correo);
		$exe=$this->db->get('usuario');

		if($this->db->affected_rows() > 0 ){
			return $exe->row();
		}else{
			return 0;
		}
	}
}
