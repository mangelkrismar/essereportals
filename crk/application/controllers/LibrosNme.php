<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LibrosNme extends MY_Controller
{
	function LibrosNme()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$a = array(
			'1' => array(// Grado
				// Libros asignados a este grado
				array(
					'titulo' => 'Español',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/nme/1/Espalol.pdf'
				),
				array(
					'titulo' => 'Matemáticas',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/nme/1/Matematicas.pdf'
				),
				array(
					'titulo' => 'Conocimiento del medio',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/nme/1/Conocimiento_del_medio.pdf'
				)
			),
			'2' => array(
				array(
					'titulo' => 'Español',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/nme/2/Espanol.pdf'
				),
				array(
					'titulo' => 'Matemáticas',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/nme/2/Matematicas.pdf'
				),
				array(
					'titulo' => 'Conocimiento del medio',
					'url'    => 'https://www.krismar-educa.com.mx/primaria_libros/nme/2/Conocimiento_del_medio.pdf'
				)
			)
		);
		echo json_encode($a);
	}
}