<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{
	function Login(){
		parent::__construct();
	}

	public function checkUser(){		
		$data = array(
			'nombre' => "Feria Internacional del Libro 2024",
			'log_in'=> true,
			'user_id' => 844,
			'diasR' => "Licencia Permanente"
		);
		$data['ulg'] = 0;
		$this->session->set_userdata($data);
		$response['acces'] = true;
		$response['msj'] = $data['diasR'];
		echo json_encode($response);
	}
	
	public function cerrarSesion(){
		$this->session->sess_destroy();
	}
}


