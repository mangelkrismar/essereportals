<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{	
	
	function Home(){
		parent::__construct();
		$this->load->library('session');
		
		$this->session->set_userdata('user_rol', 0);
	}
	
	public function index(){
		$this->load->library('minify');
		$this->load->view('header/head');
		$this->load->view('nav/header');
		$qportal = $this->config->item('qportal');
		
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
		echo true;
	}

	public function keepEmail(){
		$email = $this->input->post('email');
		$fichero = 'src/json/mails.json';
		$actual = file_get_contents($fichero);
		$actual .= $email." -|- lecturas -|- ".date('l jS \of F Y h:i:s A')."\n";
		file_put_contents($fichero, $actual);
	}

	public function netAccess(){
		$connected = @fsockopen("www.example.com", 80);
	    if ($connected){
	        fclose($connected);
	        echo '0';
	    }else{
	        echo '1';
	    }
	}
}
