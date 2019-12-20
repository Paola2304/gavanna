<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_direccion_model extends CI_Model{

	public function get_direccion(){
		$this->db->select('d.id_direccion,u.nombre,u.apellido,de.nombre_departamento,m.nombre_municipio,d.direccion,d.telefono');
		$this->db->from('direccion d');
		$this->db->join(' usuario u',' u.id_usuario=d.id_usuario');
		$this->db->join(' municipio m',' m.id_municipio=d.id_municipio');
		$this->db->join(' departamento de',' de.id_departamento=m.id_departamento');
		$exe = $this->db->get();
		return $exe->result();
	}

	public function get_usuario(){
		$exe = $this->db->get('usuario');
		return $exe->result();
	}

	public function get_departamento(){
		$exe = $this->db->get('departamento');
		return $exe->result();
	}

	public function get_municipio($id){
		$this->db->where('id_departamento',$id);
		$exe = $this->db->get('municipio');
		return $exe->result();
	}

	//Funcion eliminar
	public function eliminar($id){
		$this->db->where('id_direccion',$id);
		$this->db->delete('direccion');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}//Fin funcion eliminar

	public function set_busqueda($data){
		$this->db->select("id_usuario, nombre, apellido");
		$this->db->like("nombre",$id, "both");
		$exe = $this->db->get("usuario");
		return $exe->result();
	}

	//Funcion buscador de palabra
	public function buscar_palabra($palabra)
	{
		$this->db->select('u.id_usuario, u.nombre, u.apellido, m.id_municipio, m.municipio, d.direccion, d.telefono');
		$this->db->from('direccion d');
		$this->db->join('usuario u','u.id_usuario = d.id_usuario');
		$this->db->join('municipio m','m.id_municipio = d.id_municipio');
		$this->db->like('nombre',$palabra, 'both');
		$this->db->or_like('apellido',$palabra, 'both');
		$this->db->or_like('municipio',$palabra, 'both');
		$this->db->or_like('direccion',$palabra, 'both');
		$this->db->or_like('telefono',$palabra, 'both');

		$exe = $this->db->get();

		return $exe->result();
	}


	public function set_direccion($datos){
		$this->db->set('id_usuario',$datos["nombre"]);
		$this->db->set('id_municipio',$datos["municipio"]);
		$this->db->set('id_departamento',$datos["departamento"]);
		$this->db->set('direccion',$datos["direccion"]);
		$this->db->set('telefono',$datos["telefono"]);

		$this->db->insert('direccion');
		if($this->db->affected_rows()>0){
			return "add";
		}
	}

	//Funciones actualizar
	public function get_datos($id){
		$this->db->select('u.id_usuario, CONCAT(u.nombre," ", u.apellido) as usuario, d.id_direccion, d.id_departamento, d.id_municipio, d.direccion, d.telefono');
		$this->db->from('direccion d');
		$this->db->join('usuario u',' u.id_usuario=d.id_usuario');
		
		$this->db->where('id_direccion',$id);
		$exe = $this->db->get();

		if($this->db->affected_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}


	public function actualizar($datos){
		$this->db->set('id_usuario',$datos["nombre"]);
		$this->db->set('id_municipio',$datos["municipio"]);
		$this->db->set('id_departamento',$datos["departamento"]);
		$this->db->set('direccion',$datos["direccion"]);
		$this->db->set('telefono',$datos["telefono"]);
		$this->db->where('id_direccion',$datos['id_direccion']);
		$this->db->update('direccion');

		if($this->db->affected_rows()>0){
			return "edi";
		}
	}

}