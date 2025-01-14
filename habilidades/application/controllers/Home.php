<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{	
	
	function Home(){
		parent::__construct();
		$this->session->set_userdata('user_rol', 0);
	}
	
	public function index(){
		$this->load->library('minify');
		$this->load->view('header/head');
		$this->load->view('nav/header');
		
		if($this -> session ->userdata('log_in')){//Esta logeado
			
			$this->load->view('body/body_user');
		}else{
			
			$this->load->view('body/body');
		}
		
		$this->load->view('footer/footer');
	}

	public function ValidarSesion(){
		/*
		* NOMBRE: ValidarSesion
		* UTILIDAD: Verifica por petición si la sesion actual es la sesion activa
			* Si la sesion actual no es la sesion activa destruye la sesion.
		* ENTRADAS: Ninguna.
		* SALIDAS: booleano TRUE la sesion actual es la sesion activa, FALSE si la sesion actual no es la sesion activa.
		* VARIABLES: Ninguna.
		*/
		$result = json_encode($this->sessionActiva());
		echo $result;
	}

	private function sessionActiva(){
		/*
		* NOMBRE: sessionActiva
		* UTILIDAD: Verifica si la sesion tiene datos de session_id y user_id validos, y si estos coinciden con una sesion activa para el portal especificado.
		* ENTRADAS: Ninguna.
		* SALIDAS: booleano TRUE la sesion actual es la sesion activa, FALSE en otro caso.
		* VARIABLES: Ninguna.
		*/
		return true;
	}

	function is_connected(){
		$connected = @fsockopen("www.example.com", 80);
		if ($connected){
			$is_conn = true; //action when connected
			fclose($connected);
			echo "true";
		}else{
			$is_conn = false; //action in connection failure
			echo "false";
		}

	}

	public function keepEmail(){
		$email = $this->input->post('email');
		$fichero = 'src/json/mails.json';
		$actual = file_get_contents($fichero);
		$actual .= $email." -|- habilidades -|- ".date('l jS \of F Y h:i:s A')."\n";
		file_put_contents($fichero, $actual);
	}
}
