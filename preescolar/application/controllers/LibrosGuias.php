<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LibrosGuias extends MY_Controller{

	public function index(){
		$baseURLcatalogos = "http://localhost:8082/public/Catalogos/preescolar/";
		$a = [
			'CF' => [
				[
					'titulo' => 'Desarrollo físico y salud',
					'url'    => $baseURLcatalogos.'1/desarrolloFisico'
				],
				[
					'titulo' => 'Desarrollo personal y social',
					'url'    => $baseURLcatalogos.'1/desarrolloPersonal'
				],
				[
					'titulo' => 'Exploración y conocimiento del mundo',
					'url'    => $baseURLcatalogos.'1/mundo'
				],
				[
					'titulo' => 'Expresión artística',
					'url'    => $baseURLcatalogos.'1/artes'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLcatalogos.'1/lenguaje'
				],
				[
					'titulo' => 'Pensamiento matemático',
					'url'    => $baseURLcatalogos.'1/matematicas'
				]
			]
		];
		echo json_encode($a);
	}
}