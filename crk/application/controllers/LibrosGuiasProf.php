<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LibrosGuiasProf extends MY_Controller{

	public function index(){
		$a = array(
			'1' => array(
				array(
					'titulo' => 'Guía para el docente 1°',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/guias/1/GuiaDocenteG1.pdf'
				)
			),
			'2' => array(
				array(
					'titulo' => 'Guía para el docente 2°',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/guias/2/GuiaDocenteG2.pdf'
				)
			),
			'3' => array(
				array(
					'titulo' => 'Guía para el docente 3°',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/guias/3/GuiaDocenteG3.pdf'
				)
			),
			'4' => array(
				array(
					'titulo' => 'Guía para el docente 4°',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/guias/4/GuiaDocenteG4.pdf'
				)
			),
			'5' => array(
				array(
					'titulo' => 'Guía para el docente 5°',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/guias/5/GuiaDocenteG5.pdf'
				)
			),
			'6' => array(
				array(
					'titulo' => 'Guía para el docente 6°',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/guias/6/GuiaDocenteG6.pdf'
				)
			)
		);
		echo json_encode($a);
	}
}