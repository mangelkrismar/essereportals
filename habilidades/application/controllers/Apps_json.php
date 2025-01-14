<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps_Json extends CI_Controller {

	/*
		Al enviar un id de un curso por POST, buscará el curso en la base de datos y si lo encuentra
		devuelve un json conformado por las aplicaciones asi como una lista de los nombres de
		los grados, materias, bloques y lecciones
	*/

	function Apps_Json(){
		parent::__construct();
	}
	
	public function curso(){
		$curso = file_get_contents("src/json/habilidades2023.json");
		echo $curso;
	}

	public function demapps(){
		$readed = file_get_contents("src/json/appsHabilidades_alt.json");
	    echo openssl_decrypt ( $readed , "aes-128-cbc" , "Krismar2020-*", OPENSSL_RAW_DATA, "i7nfcinw34cf7w43" );
	}
}