<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class LibrosGuias extends MY_Controller{

	public function index(){
		$baseURLCatalogos = 'http://localhost:8082/public/Catalogos/primaria/';
		$a = [
			'1' => [
				[
					'titulo' => 'Exploración del mundo natural',
					'url'    => $baseURLCatalogos.'1/cienciasNaturales'
				],
				[
					'titulo' => 'Pensamiento crítico y solución de problemas',
					'url'    => $baseURLCatalogos.'1/desafiosMatematicos'
				],
				[
					'titulo' => 'Expresión artística',
					'url'    => $baseURLCatalogos.'1/educacionArtistica'
				],
				[
					'titulo' => 'Convivencia y ciudadanía',
					'url'    => $baseURLCatalogos.'1/civica'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLCatalogos.'1/espanol'
				],
				[
					'titulo' => 'Lecturas de comprensión',
					'url'    => $baseURLCatalogos.'1/lecturas'
				],
				[
					'titulo' => 'Pensamiento Matemático',
					'url'    => $baseURLCatalogos.'1/matematicas'
				],
				[
					'titulo' => 'Habilidades digitales',
					'url'    => $baseURLCatalogos.'1/tecnologia'
				]
			],
			'2' => [
				[
					'titulo' => 'Exploración del mundo natural',
					'url'    => $baseURLCatalogos.'2/cienciasNaturales'
				],
				[
					'titulo' => 'Pensamiento crítico y solución de problemas',
					'url'    => $baseURLCatalogos.'2/desafiosMatematicos'
				],
				[
					'titulo' => 'Expresión artística',
					'url'    => $baseURLCatalogos.'2/educacionArtistica'
				],
				[
					'titulo' => 'Convivencia y ciudadanía',
					'url'    => $baseURLCatalogos.'2/civica'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLCatalogos.'2/espanol'
				],
				[
					'titulo' => 'Lecturas de comprensión',
					'url'    => $baseURLCatalogos.'2/lecturas'
				],
				[
					'titulo' => 'Pensamiento Matemático',
					'url'    => $baseURLCatalogos.'2/matematicas'
				],
				[
					'titulo' => 'Habilidades digitales',
					'url'    => $baseURLCatalogos.'2/tecnologia'
				]
			],
			'3' => [
				[
					'titulo' => 'Exploración del mundo natural',
					'url'    => $baseURLCatalogos.'3/cienciasNaturales'
				],
				[
					'titulo' => 'Pensamiento crítico y solución de problemas',
					'url'    => $baseURLCatalogos.'3/desafiosMatematicos'
				],
				[
					'titulo' => 'Convivencia y ciudadanía',
					'url'    => $baseURLCatalogos.'3/civica'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLCatalogos.'3/espanol'
				],
				[
					'titulo' => 'Geografía',
					'url'    => $baseURLCatalogos.'3/geografia'
				],
				[
					'titulo' => 'Lecturas de comprensión',
					'url'    => $baseURLCatalogos.'3/lecturas'
				],
				[
					'titulo' => 'Pensamiento Matemático',
					'url'    => $baseURLCatalogos.'3/matematicas'
				],
				[
					'titulo' => 'Habilidades digitales',
					'url'    => $baseURLCatalogos.'3/tecnologia'
				]
			],
			'4' => [
				[
					'titulo' => 'Atlas',
					'url'    => $baseURLCatalogos.'4/atlas'
				],
				[
					'titulo' => 'Exploración del mundo natural',
					'url'    => $baseURLCatalogos.'4/cienciasNaturales'
				],
				[
					'titulo' => 'Pensamiento crítico y solución de problemas',
					'url'    => $baseURLCatalogos.'4/desafiosMatematicos'
				],
				[
					'titulo' => 'Convivencia y ciudadanía',
					'url'    => $baseURLCatalogos.'4/civica'
				],
				[
					'titulo' => 'Geografía',
					'url'    => $baseURLCatalogos.'4/geografia'
				],
				[
					'titulo' => 'Historia',
					'url'    => $baseURLCatalogos.'4/historia'
				],
				[
					'titulo' => 'Lecturas de comprensión',
					'url'    => $baseURLCatalogos.'4/lecturas'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLCatalogos.'4/espanol'
				],
				[
					'titulo' => 'Pensamiento Matemático',
					'url'    => $baseURLCatalogos.'4/matematicas'
				],
				[
					'titulo' => 'Habilidades digitales',
					'url'    => $baseURLCatalogos.'4/tecnologia'
				]
			],
			'5' => [
				[
					'titulo' => 'Atlas',
					'url'    => $baseURLCatalogos.'5/atlas'
				],
				[
					'titulo' => 'Exploración del mundo natural',
					'url'    => $baseURLCatalogos.'5/cienciasNaturales'
				],
				[
					'titulo' => 'Pensamiento crítico y solución de problemas',
					'url'    => $baseURLCatalogos.'5/desafiosMatematicos'
				],
				[
					'titulo' => 'Expresión artística',
					'url'    => $baseURLCatalogos.'5/educacionArtistica'
				],
				[
					'titulo' => 'Convivencia y ciudadanía',
					'url'    => $baseURLCatalogos.'5/civica'
				],
				[
					'titulo' => 'Geografía',
					'url'    => $baseURLCatalogos.'5/geografia'
				],
				[
					'titulo' => 'Historia',
					'url'    => $baseURLCatalogos.'5/historia'
				],
				[
					'titulo' => 'Lecturas de comprensión', 
					'url'    => $baseURLCatalogos.'5/lecturas'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLCatalogos.'5/espanol'
				],
				[
					'titulo' => 'Pensamiento Matemático',
					'url'    => $baseURLCatalogos.'5/matematicas'
				],
				[
					'titulo' => 'Habilidades digitales',
					'url'    => $baseURLCatalogos.'5/tecnologia'
				]
			],
			'6' => [
				[
					'titulo' => 'Atlas',
					'url'    => $baseURLCatalogos.'6/atlas'
				],
				[
					'titulo' => 'Exploración del mundo natural',
					'url'    => $baseURLCatalogos.'6/cienciasNaturales'
				],
				[
					'titulo' => 'Pensamiento crítico y solución de problemas',
					'url'    => $baseURLCatalogos.'6/desafiosMatematicos'
				],
				[
					'titulo' => 'Expresión artística',
					'url'    => $baseURLCatalogos.'6/educacionArtistica'
				],
				[
					'titulo' => 'Convivencia y ciudadanía',
					'url'    => $baseURLCatalogos.'6/civica'
				],
				[
					'titulo' => 'Geografía',
					'url'    => $baseURLCatalogos.'6/geografia'
				],
				[
					'titulo' => 'Historia',
					'url'    => $baseURLCatalogos.'6/historia'
				],
				[
					'titulo' => 'Lecturas de comprensión', 
					'url'    => $baseURLCatalogos.'6/lecturas'
				],
				[
					'titulo' => 'Lenguaje y comunicación',
					'url'    => $baseURLCatalogos.'6/espanol'
				],
				[
					'titulo' => 'Pensamiento Matemático',
					'url'    => $baseURLCatalogos.'6/matematicas'
				],
				[
					'titulo' => 'Habilidades digitales',
					'url'    => $baseURLCatalogos.'6/tecnologia'
				]
			]
		];
		echo json_encode($a);
	}
}