<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller{	
	
	function Home(){
		parent::__construct();
		$this->load->library('session');
		$this->session->set_userdata('user_rol', 0);
	}
	
	public function index(){
		$this->load->library('minify');
		$this->load->view('header/head');// Head normal sin regeneracion de assets
		$this->load->view('nav/header');
		if($this -> session ->userdata('log_in')){//Esta logeado
			//Traemos las aplicaciones de reciente
			$datos['apps_reciente'] = json_decode(file_get_contents("src/json/apps_recientePreescolar2023.json"));
			$this->load->view('body/body_user', $datos);
		}else{
			//Traemos aplicaciones de "conoce nuestras aplicaciones"
			$datos['apps_conoce'] = json_decode(file_get_contents("src/json/apps_conocePreescolar2023.json"));
			$this->load->view('body/body', $datos);
		}
		$this->load->view('footer/footer');
	}
	
	public function registraLogApp(){
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
	
	public function vAplicacion($typo1=""){
		/*
		* NOMBRE: vAplicacion
		* UTILIDAD: Muestra la plicación si el usuario tiene una sesión activa en primaria.
		* ENTRADAS: Ninguna.
		* SALIDAS: muestra la aplicación ó nos manada al portal de primaria.
		* VARIABLES: Ninguna.
		*/
		
		$url = $_SERVER['REQUEST_URI'];
		$aDiv = explode("/", $url);
		
		$tamano = count($aDiv);   //Obtenemos el total del array
		$qApp = $aDiv[$tamano-1];   //Es la aplicacion codificada
		
		if(is_numeric($qApp)){
			$datos["link"]= $qApp;
			$this->load->view('recursoWiew',$datos);
		}	
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
		$actual .= $email." -|- preescolar -|- ".date('l jS \of F Y h:i:s A')."\n";
		file_put_contents($fichero, $actual);
	}
}
