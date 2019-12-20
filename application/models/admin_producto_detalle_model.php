<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class admin_producto_detalle_model extends CI_Model {

	//Funciones mostrar
	public function get_producto_detalle(){	
		
		$this->db->select('pd.id_producto_detalle,p.nombre,t.talla,c.color,pd.cantidad,ca.categoria');
		$this->db->from('producto_detalle pd');
		$this->db->join('producto p', 'p.id_producto=pd.id_producto');
		$this->db->join('talla t', ' t.id_talla=pd.id_talla');
		$this->db->join('color c', 'c.id_color=pd.id_color');
		$this->db->join('categoria ca', 'ca.id_categoria=p.id_categoria');
		$exe = $this->db->get();
		return $exe->result();

	}
	public function get_producto($id){
		$this->db->where('id_categoria', $id);
		$exe = $this->db->get('producto');
		return $exe->result();
	}
	public function get_talla(){
		$exe = $this->db->get('talla');
		return $exe->result();
	}
	public function get_color(){
		$exe = $this->db->get('color');
		return $exe->result();
	}
	public function get_categoria(){
		$exe = $this->db->get('categoria');
		return $exe->result();
	}
	//Funcion buscador de palabra
	public function buscar_palabra($palabra)
	{
		$this->db->select('pd.id_producto_detalle, p.nombre, t.talla, c.color, pd.cantidad,ca.categoria');
		$this->db->from('producto_detalle pd');
		$this->db->join('producto p','p.id_producto=pd.id_producto');
		$this->db->join('talla t','t.id_talla=pd.id_talla');
		$this->db->join('color c','c.id_color=pd.id_color');
		$this->db->join('categoria ca', 'ca.id_categoria=p.id_categoria');

		//AGREGAR LAS BUSQUEDAS SEGUN FILTROS NECESARIOS
		$this->db->like('nombre',$palabra, 'both');
		$this->db->or_like('color',$palabra, 'both');
		$this->db->or_like('talla',$palabra, 'both');
		$this->db->or_like('categoria',$palabra, 'both');
		$exe = $this->db->get();
		return $exe->result();
	}

	//FUNCION ELIMINAR
	public function eliminar($id){
		$this->db->where('id_producto_detalle', $id);
		$this->db->delete('producto_detalle');

		if($this->db->affected_rows() > 0){
			return true;
		}else{
			return false;
		}
	}


	//FUNCION INGRESAR
	public function set_detalle($datos){
		$this->db->set('id_producto', $datos['producto']);
		$this->db->set('id_talla', $datos['talla']);
		$this->db->set('id_color', $datos['color']);
		$this->db->set('cantidad', $datos['cantidad']);

		$this->db->insert('producto_detalle');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}

	public function set_cantidad($datos){
		$this->db->where('id_producto', $datos['producto']);
		$this->db->where('id_talla', $datos['talla']);
		$this->db->where('id_color', $datos['color']);
		$this->db->set('cantidad', $datos['cantidad']);

		$this->db->update('producto_detalle');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}

	//FUNCION CONSULTA
	public function existencia($producto,$talla,$color){
		$this->db->where('id_producto', $producto);
		$this->db->where('id_talla', $talla);
		$this->db->where('id_color', $color);
		$respuesta = $this->db->get('producto_detalle');
		if($this->db->affected_rows()>0){
			return $respuesta->result();
		}else{
			return 0;
		}
		
	}

	//FUNCION ACTUALIZAR
	public function get_datos($id){
		$this->db->select('pd.id_producto_detalle, p.nombre, t.talla, c.color, pd.cantidad, ca.categoria');
		$this->db->from('producto_detalle pd');
		$this->db->join('producto p','p.id_producto = pd.id_producto');
		$this->db->join('categoria ca','ca.id_categoria = p.id_categoria');
		$this->db->join('talla t','t.id_talla = pd.id_talla');
		$this->db->join('color c','c.id_color = pd.id_color');
		$this->db->where('pd.id_producto_detalle',$id);
		$exe = $this->db->get();

		if($exe->num_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}
	public function actualizar($datos){
		$this->db->set('cantidad',$datos['cantidad']);
		$this->db->where('id_producto_detalle',$datos['id']);
		$this->db->update('producto_detalle');

		if($this->db->affected_rows()>0){
			return "edi";
		}
	}
	/*public function get_imagen($id){	
		$this->db->where('id_categoria',$id);
		$exe= $this->db->get('categoria');
		return $exe->result();
	}*/

}


?>