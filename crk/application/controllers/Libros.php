 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libros extends MY_Controller
{	
	function Libros(){
		parent::__construct();
	}
	public function index(){
		$baseURLlibros = 'http://localhost:8082/public/Catalogos/primaria/';
		$libros_json = [
			"1" => [
				[
                    "titulo" => "Conocimiento del medio",
                    "url" => $baseURLlibros."1/cienciasNaturales"
                ],
				[
                    "titulo" => "Lengua materna. Español",
                    "url" => $baseURLlibros."1/espanol"
                ],
				[
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."1/civica"
                ],
				[
                    "titulo" => "Lecturas",
                    "url" => $baseURLlibros."1/lecturas"
                ],
				[
                    "titulo" => "Matemáticas",
                    "url" => $baseURLlibros."1/matematicas"
                ]
            ],
            "2" => [
				[
                    "titulo" => "Conocimiento del medio",
                    "url" => $baseURLlibros."2/cienciasNaturales"
                ],
				[
                    "titulo" => "Lengua materna. Español",
                    "url" => $baseURLlibros."2/espanol"
                ],
				[
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."2/civica"
                ],
				[
                    "titulo" => "Lecturas",
                    "url" => $baseURLlibros."2/lecturas"
                ],
				[
                    "titulo" => "Matemáticas",
                    "url" => $baseURLlibros."2/matematicas"
                ]
            ],
            "3" => [
				[
                    "titulo" => "Ciencias naturales",
                    "url" => $baseURLlibros."3/cienciasNaturales"
                ],
				[
                    "titulo" => "Desafios matemáticos",
                    "url" => $baseURLlibros."3/matematicas"
                ],
				[
                    "titulo" => "Lengua materna. Español",
                    "url" => $baseURLlibros."3/espanol"
                ],
				[
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."3/civica"
                ],
				[
                    "titulo" => "Lecturas",
                    "url" => $baseURLlibros."3/lecturas"
                ],
				[
                    "titulo" => "La entidad donde vivo: Aguascalientes",
                    "url" => $baseURLlibros."3/Aguascalientes"
                ],
				[
                    "titulo" => "La entidad donde vivo: Baja California",
                    "url" => $baseURLlibros."3/BajaCalifornia"
                ],
				[
                    "titulo" => "La entidad donde vivo: Baja California Sur",
                    "url" => $baseURLlibros."3/BajaCaliforniaSur"
                ],
				[
                    "titulo" => "La entidad donde vivo: Campeche",
                    "url" => $baseURLlibros."3/Campeche"
                ],
				[
                    "titulo" => "La entidad donde vivo: Ciudad de México",
                    "url" => $baseURLlibros."3/CiudadDeMexico"
                ],
				[
                    "titulo" => "La entidad donde vivo: Chihuahua",
                    "url" => $baseURLlibros."3/Chihuahua"
                ],
				[
                    "titulo" => "La entidad donde vivo: Chiapas",
                    "url" => $baseURLlibros."3/Chiapas"
                ],
				[
                    "titulo" => "La entidad donde vivo: Coahuila de Zaragoza",
                    "url" => $baseURLlibros."3/Coahuila"
                ],
				[
                    "titulo" => "La entidad donde vivo: Colima",
                    "url" => $baseURLlibros."3/Colima"
                ],
				[
                    "titulo" => "La entidad donde vivo: Durango",
                    "url" => $baseURLlibros."3/Durango"
                ],
				[
                    "titulo" => "La entidad donde vivo: Guerrero",
                    "url" => $baseURLlibros."3/Guerrero"
                ],
				[
                    "titulo" => "La entidad donde vivo: Guanajuato",
                    "url" => $baseURLlibros."3/Guanajuato"
                ],
				[
                    "titulo" => "La entidad donde vivo: Hidalgo",
                    "url" => $baseURLlibros."3/Hidalgo"
                ],
				[
                    "titulo" => "La entidad donde vivo: Jalisco",
                    "url" => $baseURLlibros."3/Jalisco"
                ],
				[
                    "titulo" => "La entidad donde vivo: Estado de México",
                    "url" => $baseURLlibros."3/EstadoDeMexico"
                ],
				[
                    "titulo" => "La entidad donde vivo: Michoacán",
                    "url" => $baseURLlibros."3/Michoacan"
                ],
				[
                    "titulo" => "La entidad donde vivo: Nayarit",
                    "url" => $baseURLlibros."3/Nayarit"
                ],
				[
                    "titulo" => "La entidad donde vivo: Nuevo León",
                    "url" => $baseURLlibros."3/NuevoLeon"
                ],
				[
                    "titulo" => "La entidad donde vivo: Oaxaca",
                    "url" => $baseURLlibros."3/Oaxaca"
                ],
				[
                    "titulo" => "La entidad donde vivo: Quintana Roo",
                    "url" => $baseURLlibros."3/QuintanaRoo"
                ],
				[
                    "titulo" => "La entidad donde vivo: Querétaro",
                    "url" => $baseURLlibros."3/Queretaro"
                ],
				[
                    "titulo" => "La entidad donde vivo: Sinaloa",
                    "url" => $baseURLlibros."3/Sinaloa"
                ],
				[
                    "titulo" => "La entidad donde vivo: San Luis Potosí",
                    "url" => $baseURLlibros."3/SanLuisPotosi"
                ],
				[
                    "titulo" => "La entidad donde vivo: Sonora",
                    "url" => $baseURLlibros."3/Sonora"
                ],
				[
                    "titulo" => "La entidad donde vivo: Tabasco",
                    "url" => $baseURLlibros."3/Tabasco"
                ],
				[
                    "titulo" => "La entidad donde vivo: Tamaulipas",
                    "url" => $baseURLlibros."3/Tamaulipas"
                ],
				[
                    "titulo" => "La entidad donde vivo: Tlaxcala",
                    "url" => $baseURLlibros."3/Tlaxcala"
                ],
				[
                    "titulo" => "La entidad donde vivo: Veracruz",
                    "url" => $baseURLlibros."3/Veracruz"
                ],
				[
                    "titulo" => "La entidad donde vivo: Yucatán",
                    "url" => $baseURLlibros."3/Yucatan"
                ],
				[
                    "titulo" => "La entidad donde vivo: Zacatecas",
                    "url" => $baseURLlibros."3/Zacatecas"
                ]
            ],
            "4" => [
				[
                    "titulo" => "Atlas de México",
                    "url" => $baseURLlibros."4/atlas"
                ],
				[
                    "titulo" => "Conoce nuestra Constitución",
                    "url" => $baseURLlibros."4/constitucion"
                ],
				[
                    "titulo" => "Ciencias Naturales",
                    "url" => $baseURLlibros."4/cienciasNaturales"
                ],
				[
                    "titulo" => "Desafíos matemáticos",
                    "url" => $baseURLlibros."4/matematicas"
                ],
				[
                    "titulo" => "Lengua materna. Español",
                    "url" => $baseURLlibros."4/espanol"
                ],
				[
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."4/civica"
                ],
				[
                    "titulo" => "Geografía",
                    "url" => $baseURLlibros."4/geografia"
                ],
				[
                    "titulo" => "Historia",
                    "url" => $baseURLlibros."4/historia"
                ],
				[
                    "titulo" => "Lecturas",
                    "url" => $baseURLlibros."4/lecturas"
                ]
            ],
            "5" => [
				[
                    "titulo" => "Atlas de geografía del mundo",
                    "url" => $baseURLlibros."5/atlas"
                ],
				[
                    "titulo" => "Ciencias naturales",
                    "url" => $baseURLlibros."5/cienciasNaturales"
                ],
				[
                    "titulo" => "Desafíos matemáticos",
                    "url" => $baseURLlibros."5/matematicas"
                ],
				[
                    "titulo" => "Español",
                    "url" => $baseURLlibros."5/espanol"
                ],
				[
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."5/civica"
                ],
				[
                    "titulo" => "Geografía",
                    "url" => $baseURLlibros."5/geografia"
                ],
				[
                    "titulo" => "Historia",
                    "url" => $baseURLlibros."5/historia"
                ],
				[
                    "titulo" => "Lecturas",
                    "url" => $baseURLlibros."5/lecturas"
                ],
				[
                    "titulo" => "Primero las niñas y los niños. Un libro para conocer y ejercer nuestros derechos humanos",
                    "url" => $baseURLlibros."5/primero"
                ],
				[
                    "titulo" => "Formación cívica y ética. Cuaderno de aprendizaje",
                    "url" => $baseURLlibros."5/civicaCuaderno"
                ]
            ],
            "6" => [
				[
                    "titulo" => "Ciencias naturales",
                    "url" => $baseURLlibros."6/cienciasNaturales"
                ],
				[
                    "titulo" => "Desafíos matemáticos",
                    "url" => $baseURLlibros."6/matematicas"
                ],
				[
                    "titulo" => "Español",
                    "url" => $baseURLlibros."6/espanol"
                ],
				[
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."6/civica"
                ],
				[
                    "titulo" => "Geografía",
                    "url" => $baseURLlibros."6/geografia"
                ],
				[
                    "titulo" => "Historia",
                    "url" => $baseURLlibros."6/historia"
                ],
				[
                    "titulo" => "Lecturas",
                    "url" => $baseURLlibros."6/lecturas"
                ],
				[
                    "titulo" => "Cuaderno de actividades. Geografía",
                    "url" => $baseURLlibros."6/geografiaCuaderno"
                ],
				[
                    "titulo" => "Formación cívica y ética. Cuaderno de aprendizaje",
                    "url" => $baseURLlibros."6/civicaCuaderno"
                ]
            ]
		];
		echo json_encode($libros_json);
	}
}
