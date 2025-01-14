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

	
	
	public function cursoByID(){
		$curso = file_get_contents('src/json/curso.json', true);
		echo $curso;
	}

	public function demapps(){
		$qportal = $this->config->item('qportal');
		$res['primaria'] = file_get_contents('src/json/primaria.json', true);
		$res['secundaria'] = file_get_contents('src/json/secundaria.json', true);
		echo json_encode($res);
	}
}