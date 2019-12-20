<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_producto_model extends CI_Model {

//mostrar
	public function get_producto(){
		$this->db->select('p.id_producto,p.nombre,p.precio,p.descripcion,c.categoria');
		$this->db->from('producto p');
		$this->db->join('categoria c','c.id_categoria=p.id_categoria');
		$exe = $this->db->get();
		return $exe->result();
	}

	public function get_imagen($id){
		$this->db->where('id_producto',$id);
		$exe = $this->db->get('imagen');
			return $exe->result();
	}

//get categoria
	public function get_categoria(){
		$exe = $this->db->get('categoria');
		return $exe->result();
	}

//Funcion buscador de palabra
	public function buscar_palabra($palabra)
	{
		$this->db->select('p.id_producto,p.nombre,p.precio,p.descripcion,c.categoria');
		$this->db->from('producto p');
		$this->db->join('categoria c','c.id_categoria=p.id_categoria');
		//AGREGAR LAS BUSQUEDAS
		$this->db->like('nombre',$palabra, 'both');
		$this->db->or_like('precio',$palabra, 'both');
		$this->db->or_like('descripcion',$palabra, 'both');
		$this->db->or_like('categoria',$palabra, 'both');
		$exe = $this->db->get();

		return $exe->result();
	}
//funcion eliminar
	public function eliminar($id)
	{
		$this->db->where('id_producto',$id);
		$this->db->delete('producto');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	public function eliminarI($id)
	{	
		$this->db->where('id_imagen',$datos["id"]);
		$this->db->where('id_producto',$datos["idProducto"]);
		$this->db->delete('imagen');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

//Funcion ingresar
	public function set_producto($datos){	
		$this->db->set('nombre', $datos["nombre"]);
		$this->db->set('precio', $datos["precio"]);
		$this->db->set('descripcion', $datos["descripcion"]);
		$this->db->set('id_categoria', $datos["categoria"]);
	    $this->db->insert('producto');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}

//get_datos
	public function get_datos($id){
		$this->db->where('id_producto',$id);
		$exe = $this->db->get('producto');

		if($exe->num_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}

//actualizar
	public function actualizar($datos){
		$this->db->set('nombre', $datos["nombre"]);
		$this->db->set('precio', $datos["precio"]);
		$this->db->set('descripcion', $datos["descripcion"]);
		$this->db->set('id_categoria', $datos["categoria"]);
		$this->db->where('id_producto',$datos['id_producto']);
		$this->db->update('producto');

		if($this->db->affected_rows()>0){
			return "edi";
		}
	
}
}
