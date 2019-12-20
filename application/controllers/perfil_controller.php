<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class perfil_controller extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('perfil_model');
	}
	public function index()
	{

		$data= array (
			'title'	=> 'Perfil');
		$this->load->view('template/header',$data);
		$this->load->view('template/navbar');
		$this->load->view('perfil_view');
		$this->load->view('template/footer');
		
	}
	//Funcion Iniciar sesion----------------------------------------------------------------
	public function acceder(){
		$datos['correo'] = $this->input->post('correoi');
		$datos['clave'] = md5($this->input->post('passi'));
		$data = $this->perfil_model->validar($datos);
		if($data){
			//variables de sesion
			$datos_usuario = array('id' => $data->id_usuario, 'nombre'=> $data->nombre." ".$data->apellido, 'rol'=> $data->id_rol,'logueado' => TRUE);
			$this->session->set_userdata($datos_usuario);
			//Agregar un if que redireccione si no es el administrador
			echo json_encode($data);

		}else{
			echo json_encode('Error');
		}
	}


	//Funcion recuperar contraseña----------------------------------------------------------
	public function send(){
		$correo = $this->input->post('RecoveryCorreo');
		$datos= $this->perfil_model->get_correo($correo);


//SCRIP 
		$str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
		$password = "";
   //Reconstruimos la contraseña segun la longitud que se quiera
		for($i=0;$i<11;$i++) {
      //obtenemos un caracter aleatorio escogido de la cadena de caracteres
			$password .= substr($str,rand(0,62),1);
		}
   //Mostramos la contraseña generada

		if ($datos) {
			foreach ($datos as $d) {
				$id=$d->id_usuario;
				$passwordmd5=md5($password);
				$this->perfil_model->act_pass($passwordmd5,$id);

            // Load PHPMailer library
				$this->load->library('phpmailer_lib');

        // PHPMailer object
				$mail = $this->phpmailer_lib->load();

        // SMTP configuration
				$mail->isSMTP();
				$mail->Host     = 'smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Username = 'hectocallesphp@gmail.com';
				$mail->Password = 'Prueba123PHP';
				$mail->SMTPSecure = 'ssl';
				$mail->Port     = 465;

				$mail->setFrom('hectocallesphp@gmail.com', 'Recuperacion de cuenta');
				$mail->addReplyTo('hectocallesphp@gmail.com', 'Recuperacion de cuenta');

        // Add a recipient
				$mail->addAddress($d->correo);

        // Add cc or bcc 
				$mail->addCC('');
				$mail->addBCC('');

        // Email subject
				$mail->Subject = 'Recuperacion de cuenta';

        // Set email format to HTML
				$mail->isHTML(true);

        // Email body content
				$mailContent = "<h1>Estimado/a ".$d->nombre." ".$d->apellido."</h1>
				<p>Ingresa con tu correo ".$d->correo.
				",<br>y la clave de recuperacion de cuenta es <b>".$password."</b></p>";
				$mail->Body = $mailContent;

        // Send email
				if(!$mail->send()){
					echo json_encode('Error');
					echo 'Mailer Error: '.$mail->ErrorInfo;
				}else{
					echo json_encode('Exito');
				}
			}

		}else{
			echo json_encode('Error'); 
		}
	}

//Funcion Registrarse----------------------------------------------------------------
	public function registrarse(){
		$datos['nombre'] = $this->input->post('nombreR');
		$datos['apellido'] = $this->input->post('apellidoR');
		$datos['correo'] = $this->input->post('correoR');
		$datos['clave'] = md5($this->input->post('passR'));
		$datos['rol'] = 2;
		$this->perfil_model->registrar($datos);

		$data = $this->perfil_model->validar($datos);
		if($data){
			//variables de sesion
			$datos_usuario = array('id' => $data->id_usuario, 'nombre'=> $data->nombre." ".$data->apellido, 'rol'=> $data->id_rol,'logueado' => TRUE);
			$this->session->set_userdata($datos_usuario);
			//Agregar un if que redireccione si no es el administrador
			echo json_encode($data);

		}else{
			echo json_encode('Error');
		}
	}

	//CONSULTAS
	public function validarCorreo()
	{	
		$correo = $this->input->post('correo');
		$respuesta = $this->perfil_model->validarCorreo($correo);
		echo json_encode($respuesta);
	}

	//Metodo para cerrar sesion y destruir la variable de sesion
	public function cerrar(){

		$user_data = array('Logueado' => FALSE);
		$this->session->set_userdata($user_data);
		$this->session->sess_destroy();
		
		echo json_encode('Exito');

	}

	//Actualizar contraseña
	public function change()
	{	
		$datos['clave'] = md5($this->input->post('pass2'));
		$datos['nueClave']= md5($this->input->post('passCp'));
		$datos['id'] = $this->session->userdata('id');
		$respuesta = $this->perfil_model->change($datos);
		echo json_encode($respuesta);
	}


}
