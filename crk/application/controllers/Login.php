<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends MY_Controller{
	function Login(){
		parent::__construct();
		$this->load->library('session');
	}

	public function checkUser(){
		$diasR = 'Licencia permanente';
		$data = array(
			'nombre' => 'Feria Internacional del Libro 2024',
			'log_in'=> true,
			'user_id' => 0,
			'diasR' => $diasR,
			'qEmp' => 0
		);
		$this->session->set_userdata($data);
		$response['acces'] = true;
		$response['msj'] = $diasR;
		echo json_encode($response);
	}
	
	public function cerrarSesion(){
		$this->session->sess_destroy();
	}
}


