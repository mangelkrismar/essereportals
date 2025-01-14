<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LibrosGuiasProf extends MY_Controller{

	public function index(){
		$a = array(
			'1' => array(
				array(
					'titulo' => 'Guía para el docente 1°',
					'url'    => 'src/pdf/GuiaDocenteG1.pdf'
				)
			),
			'2' => array(
				array(
					'titulo' => 'Guía para el docente 2°',
					'url'    => 'src/pdf/GuiaDocenteG2.pdf'
				)
			),
			'3' => array(
				array(
					'titulo' => 'Guía para el docente 3°',
					'url'    => 'src/pdf/GuiaDocenteG3.pdf'
				)
			),
			'4' => array(
				array(
					'titulo' => 'Guía para el docente 4°',
					'url'    => 'src/pdf/GuiaDocenteG4.pdf'
				)
			),
			'5' => array(
				array(
					'titulo' => 'Guía para el docente 5°',
					'url'    => 'src/pdf/GuiaDocenteG5.pdf'
				)
			),
			'6' => array(
				array(
					'titulo' => 'Guía para el docente 6°',
					'url'    => 'src/pdf/GuiaDocenteG6.pdf'
				)
			)
		);
		echo json_encode($a);
	}
}