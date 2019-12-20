<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin_pedido_model extends CI_Model {

	//Funciones mostrar
	public function get_pedido()
	{	
		$this->db->select('p.id_pedido, u.nombre, u.apellido, p.fecha, p.cargo_envio, e.estado');
		$this->db->from('pedido p');
		$this->db->join('usuario u','u.id_usuario=p.id_usuario');
		$this->db->join('estado_pedido e','e.id_estado=p.id_estado');
		$exe= $this->db->get();
		return $exe->result();
	}

	public function get_usuario(){
		$exe = $this->db->get('usuario');
		return $exe->result();
	}

	public function get_categoria(){
		$exe = $this->db->get('categoria');
		return $exe->result();
	}

	public function get_producto($id){
		//$this->db->select('id_producto', $id);
		//$this->db->from('producto');
		$this->db->where('id_categoria',$id);
		$exe = $this->db->get('producto');
		return $exe->result();
	}

	public function get_talla(){
		$this->db->select('id_talla, talla');
		$this->db->from('talla');
		$exe = $this->db->get();
		return $exe->result();
	}

	public function get_color(){
		$this->db->select('id_color, color');
		$this->db->from('color');
		$exe = $this->db->get();
		return $exe->result();
	}

	public function set_cantidad($datos){
		$this->db->where('id_producto', $datos['producto']);
		$this->db->where('id_talla', $datos['talla']);
		$this->db->where('id_color', $datos['color']);
		//$this->db->set('cantidad', $datos['cantidad']);
		$this->db->set('cantidad', $datos['cantidad']);
		//$this->db->update('detalles');

		$this->db->update('producto_detalle');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}
	public function set_cantidad1($datos){
		$this->db->where('id_producto', $datos['producto']);
		$this->db->where('id_talla', $datos['talla']);
		$this->db->where('id_color', $datos['color']);
		//$this->db->set('cantidad', $datos['cantidad']);
		$this->db->set('cantidad', $datos['cantidad']);
		//$this->db->update('detalles');

		$this->db->update('detalles');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}

	public function get_detalle($id){
		$this->db->select(' p.id_producto_detalle, pr.nombre, p.cantidad, t.talla, c.color,ca.categoria');
		$this->db->from('detalles p');
		$this->db->join('producto_detalle pd','pd.id_producto_detalle = p.id_producto_detalle');
		$this->db->join('producto pr ','pr.id_producto = pd.id_producto');
		$this->db->join('talla t ','t.id_talla = pd.id_talla');
		$this->db->join('categoria ca','ca.id_categoria = pr.id_categoria');
		$this->db->join('color c ','c.id_color = pd.id_color');
		$this->db->where('p.id_pedido',$id);
		$exe = $this->db->get();
		return $exe->result();
	}//aqui va el select

	public function get_estado_pedido(){
		$exe = $this->db->get('estado_pedido');
		return $exe->result();
	}

	//Funcion buscador de palabra
	public function buscar_palabra($palabra)
	{
		$this->db->select('p.id_pedido, u.nombre, u.apellido, p.fecha, p.subtotal, p.cargo_envio, p.monto_total, e.estado');
		$this->db->from('pedido p');
		$this->db->join('usuario u','u.id_usuario=p.id_usuario');
		$this->db->join('estado_pedido e','e.id_estado=p.id_estado');
		//AGREGAR LAS BUSQUEDAS SEGUN FILTROS NECESARIOS
		$this->db->like('nombre',$palabra, 'both');
		$this->db->or_like('apellido',$palabra, 'both');
		$this->db->or_like('estado',$palabra, 'both');
		$exe = $this->db->get();

		return $exe->result();
	}
	//funcion eliminar
	public function eliminar($id)
	{
		$this->db->where('id_pedido',$id);
		$this->db->delete('pedido');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	//funcion eliminar detalles
	public function eliminar2($id)
	{
		$this->db->where('id_pedido',$id);
		$this->db->delete('detalles');

		if ($this->db->affected_rows() > 0 ) {
			return true;
		}else{
			return false;
		}
	}

	//Funcion ingresar
	public function set_pedido($datos){
		
		$this->db->set('id_usuario', $datos["usuario"]);
		$this->db->set('fecha', $datos["fecha"]);
		//$this->db->set('subtotal', $datos["subtotal"]);
		$this->db->set('cargo_envio', $datos["cargo_envio"]);
		$this->db->set('id_estado', $datos["estado"]);
		
		$this->db->insert('pedido');

		if($this->db->affected_rows()>0){
			return "add";
		}
	} //fin del ingresar

	public function set_detalle($datos){
		$this->db->where('id_producto', $datos['producto']);
		$this->db->where('id_talla', $datos['talla']);
		$this->db->where('id_color', $datos['color']);
		$this->db->set('cantidad', $datos['cantidad']);

		$this->db->update('detalles');

		if($this->db->affected_rows()>0){
			return "add";
		}
	}//ingresar detalle

	//Funciones actualizar
	public function get_datos($id){
		$this->db->where('id_pedido',$id);
		$exe = $this->db->get('pedido');

		if($exe->num_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}


	public function actualizar($datos){
		$this->db->set('id_usuario', $datos["usuario"]);
		$this->db->set('fecha', $datos["fecha"]);
		$this->db->set('cargo_envio', $datos["cargo_envio"]);
		$this->db->set('id_estado', $datos["estado"]);
		$this->db->where('id_pedido',$datos['id']);
		$this->db->update('pedido');

		if($this->db->affected_rows()>0){
			return "edi";
		}
	} // fin del actualizar
//funciones actualizar
	public function get_datosDetalle($id){
		$this->db->where('id_pedido',$id);
		$exe = $this->db->get('detalles');

		if($exe->num_rows()>0){
			return $exe->row();
		}else{
			return false;
		}
	}

	public function actualizarDetalle($datos){
		$this->db->set('cantidad', $datos["cantidad"]);
		$this->db->where('id_pedido',$datos['id']);
		$this->db->update('detalles');

		if($this->db->affected_rows()>0){
			return "edi";
		}
	} // fin del actualizar

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
}
