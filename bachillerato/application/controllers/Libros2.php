<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libros2 extends MY_Controller {
	public function libros()
	{
		$baseUrlLibros = 'http://localhost:8082/public/Libros/librosConaliteg/bachillerato/';
		$libros_json = [
			"1" => [
		        [
		            "titulo" => "Lengua adicional al Español I",
		            "url" => $baseUrlLibros."1/lengua"
		        ],
		        [
		            "titulo" => "Ética y valores I",
		            "url" => $baseUrlLibros."1/etica"
		        ],
		        [
		            "titulo" => "Física I",
		            "url" => $baseUrlLibros."1/fisica"
		        ],
		        [
		            "titulo" => "Metodología de la investigación",
		            "url" => $baseUrlLibros."1/metodologia"
		        ],
		        [
		            "titulo" => "Matemáticas I",
		            "url" => $baseUrlLibros."1/matematicas"
		        ],
		        [
		            "titulo" => "Taller de lectura y redacción I",
		            "url" => $baseUrlLibros."1/lectura"
		        ]
		    ],
		    "2" => [
		        [
		            "titulo" => "Lengua adicional al Español II",
		            "url" => $baseUrlLibros."2/lengua"
		        ],
		        [
		            "titulo" => "Ética y valores II",
		            "url" => $baseUrlLibros."2/etica"
		        ],
		        [
		            "titulo" => "Física II",
		            "url" => $baseUrlLibros."2/fisica"
		        ],
		        [
		            "titulo" => "Introducción a las ciencias sociales",
		            "url" => $baseUrlLibros."2/ciencias"
		        ],
		        [
		            "titulo" => "Matemáticas II",
		            "url" => $baseUrlLibros."2/matematicas"
		        ],
		        [
		            "titulo" => "Taller de lectura y redacción II",
		            "url" => $baseUrlLibros."2/lectura"
		        ]
		    ],
			"3" => [
		        [
		            "titulo" => "Lengua adicional al Español III",
		            "url" => $baseUrlLibros."3/lengua"
		        ],
		        [
		            "titulo" => "Biología I",
		            "url" => $baseUrlLibros."3/biologia"
		        ],
		        [
		            "titulo" => "Desarrollo comunitario",
		            "url" => $baseUrlLibros."3/desarrollo"
		        ],
		        [
		            "titulo" => "Historia de México I",
		            "url" => $baseUrlLibros."3/historia"
		        ],
		        [
		            "titulo" => "Literatura I",
		            "url" => $baseUrlLibros."3/literatura"
		        ],
		        [
		            "titulo" => "Matemáticas III",
		            "url" => $baseUrlLibros."3/matematicas"
		        ],
		        [
		            "titulo" => "Química I",
		            "url" => $baseUrlLibros."3/quimica"
		        ]
		    ],
			"4" => [
		        [
		            "titulo" => "Lengua adicional al Español IV",
		            "url" => $baseUrlLibros."4/lengua"
		        ],
		        [
		            "titulo" => "Biología II",
		            "url" => $baseUrlLibros."4/biologia"
		        ],
		        [
		            "titulo" => "Historia de México II",
		            "url" => $baseUrlLibros."4/historia"
		        ],
		        [
		            "titulo" => "Literatura II",
		            "url" => $baseUrlLibros."4/literatura"
		        ],
		        [
		            "titulo" => "Matemáticas IV",
		            "url" => $baseUrlLibros."4/matematicas"
		        ],
		        [
		            "titulo" => "Química II",
		            "url" => $baseUrlLibros."4/quimica"
		        ]
		    ],
			"5" => [
		        [
		            "titulo" => "Ciencias de la comunicación I",
		            "url" => $baseUrlLibros."5/comunicacion"
		        ],
		        [
		            "titulo" => "Desarrollo comunitario",
		            "url" => $baseUrlLibros."5/desarrollo"
		        ],
		        [
		            "titulo" => "Probabilidad y estadística I",
		            "url" => $baseUrlLibros."5/probabilidad"
		        ],
		        [
		            "titulo" => "Geografía",
		            "url" => $baseUrlLibros."5/geografia"
		        ],
		        [
		            "titulo" => "Derecho I",
		            "url" => $baseUrlLibros."5/derecho"
		        ],
		        [
		            "titulo" => "Estructura socioeconómica de México",
		            "url" => $baseUrlLibros."5/socioeconomica"
		        ],
		        [
		            "titulo" => "Ciencias de la salud I",
		            "url" => $baseUrlLibros."5/salud"
		        ]
		    ],
			"6" => [
		        [
		            "titulo" => "Ecología y medio ambiente",
		            "url" => $baseUrlLibros."6/ecologia"
		        ],
		        [
		            "titulo" => "Ciencias de la comunicación II",
		            "url" => $baseUrlLibros."6/comunicacion"
		        ],
		        [
		            "titulo" => "Probabilidad y estadística II",
		            "url" => $baseUrlLibros."6/probabilidad"
		        ],
		        [
		            "titulo" => "Filosofía",
		            "url" => $baseUrlLibros."6/filosofia"
		        ],
		        [
		            "titulo" => "Historia universal contemporánea",
		            "url" => $baseUrlLibros."6/historia"
		        ],
		        [
		            "titulo" => "Derecho II",
		            "url" => $baseUrlLibros."6/derecho"
		        ],
		        [
		            "titulo" => "Ciencias de la salud II",
		            "url" => $baseUrlLibros."6/salud"
		        ]
		    ]
		];
		echo json_encode($libros_json);
	}

	public function catalogos(){
		$baseUrlCatalogos = 'http://localhost:8082/public/Catalogos/bachillerato/';
		$libros_json = [
			"1" => [
		        [
		            "titulo" => "Ciencias de la comunicación",
		            "url" => $baseUrlCatalogos."1/comunicacion"
		        ],
		        [
		            "titulo" => "Ética y valores",
		            "url" => $baseUrlCatalogos."1/etica"
		        ],
		        [
		            "titulo" => "Física",
		            "url" => $baseUrlCatalogos."1/fisica"
		        ],
		        [
		            "titulo" => "Matemáticas",
		            "url" => $baseUrlCatalogos."1/matematicas"
		        ],
		        [
		            "titulo" => "Metodología de la investigación",
		            "url" => $baseUrlCatalogos."1/metodologiaInvestigacion"
		        ],
		        [
		            "titulo" => "Tecnología",
		            "url" => $baseUrlCatalogos."1/tecnologia"
		        ],
		        [
		            "titulo" => "Taller de lectura y redacción",
		            "url" => $baseUrlCatalogos."1/tallerLectura"
		        ]
		    ],
		    "2" => [
		        [
		            "titulo" => "Ciencias sociales",
		            "url" => $baseUrlCatalogos."2/cienciasSociales"
		        ],
		        [
		            "titulo" => "Educación artística",
		            "url" => $baseUrlCatalogos."2/educacionArtistica"
		        ],
		        [
		            "titulo" => "Ética y valores",
		            "url" => $baseUrlCatalogos."2/etica"
		        ],
		        [
		            "titulo" => "Física",
		            "url" => $baseUrlCatalogos."2/fisica"
		        ],
		        [
		            "titulo" => "Matemáticas",
		            "url" => $baseUrlCatalogos."2/matematicas"
		        ],
		        [
		            "titulo" => "Tecnología",
		            "url" => $baseUrlCatalogos."2/tecnologia"
		        ],
		        [
		            "titulo" => "Taller de lectura y redacción",
		            "url" => $baseUrlCatalogos."2/tallerLectura"
		        ]
		    ],
		    "3" => [
		        [
		            "titulo" => "Biología",
		            "url" => $baseUrlCatalogos."3/biologia"
		        ],
		        [
		            "titulo" => "Desarrollo comunitario",
		            "url" => $baseUrlCatalogos."3/desarrolloComunitario"
		        ],
		        [
		            "titulo" => "Historia de México",
		            "url" => $baseUrlCatalogos."3/historia"
		        ],
		        [
		            "titulo" => "Literatura",
		            "url" => $baseUrlCatalogos."3/literatura"
		        ],
		        [
		            "titulo" => "Matemáticas",
		            "url" => $baseUrlCatalogos."3/matematicas"
		        ],
		        [
		            "titulo" => "Tecnología",
		            "url" => $baseUrlCatalogos."3/tecnologia"
		        ],
		        [
		            "titulo" => "Química",
		            "url" => $baseUrlCatalogos."3/quimica"
		        ]
		    ],
		    "4" => [
		        [
		            "titulo" => "Biología",
		            "url" => $baseUrlCatalogos."4/biologia"
		        ],
		        [
		            "titulo" => "Desarrollo comunitario",
		            "url" => $baseUrlCatalogos."4/desarrolloComunitario"
		        ],
		        [
		            "titulo" => "Historia de México",
		            "url" => $baseUrlCatalogos."4/historia"
		        ],
		        [
		            "titulo" => "Lecturas de comprensión",
		            "url" => $baseUrlCatalogos."4/lecturas"
		        ],
		        [
		            "titulo" => "Literatura",
		            "url" => $baseUrlCatalogos."4/literatura"
		        ],
		        [
		            "titulo" => "Matemáticas",
		            "url" => $baseUrlCatalogos."4/matematicas"
		        ],
		        [
		            "titulo" => "Tecnología",
		            "url" => $baseUrlCatalogos."4/tecnologia"
		        ],
		        [
		            "titulo" => "Química",
		            "url" => $baseUrlCatalogos."4/quimica"
		        ]
		    ],
		    "5" => [
		        [
		            "titulo" => "Ciencias de la comunicación",
		            "url" => $baseUrlCatalogos."5/comunicacion"
		        ],
		        [
		            "titulo" => "Ciencias de la salud",
		            "url" => $baseUrlCatalogos."5/cienciasSalud"
		        ],
		        [
		            "titulo" => "Derecho",
		            "url" => $baseUrlCatalogos."5/derecho"
		        ],
		        [
		            "titulo" => "Desarrollo comunitario",
		            "url" => $baseUrlCatalogos."5/desarrolloComunitario"
		        ],
		        [
		            "titulo" => "Estructura socioeconómica de México",
		            "url" => $baseUrlCatalogos."5/economia"
		        ],
		        [
		            "titulo" => "Geografía",
		            "url" => $baseUrlCatalogos."5/geografia"
		        ],
		        [
		            "titulo" => "Tecnología",
		            "url" => $baseUrlCatalogos."5/tecnologia"
		        ],
		        [
		            "titulo" => "Probabilidad y estadística",
		            "url" => $baseUrlCatalogos."5/probabilidad"
		        ]
		    ],
		    "6" => [
		        [
		            "titulo" => "Ciencias de la comunicación",
		            "url" => $baseUrlCatalogos."6/comunicacion"
		        ],
		        [
		            "titulo" => "Ciencias de la salud",
		            "url" => $baseUrlCatalogos."6/cienciasSalud"
		        ],
		        [
		            "titulo" => "Derecho",
		            "url" => $baseUrlCatalogos."6/derecho"
		        ],
		        [
		            "titulo" => "Desarrollo comunitario",
		            "url" => $baseUrlCatalogos."6/desarrolloComunitario"
		        ],
		        [
		            "titulo" => "Ecología",
		            "url" => $baseUrlCatalogos."6/ecologia"
		        ],
		        [
		            "titulo" => "Educación artística",
		            "url" => $baseUrlCatalogos."6/educacionArtística"
		        ],
		        [
		            "titulo" => "Filosofía",
		            "url" => $baseUrlCatalogos."6/filosofia"
		        ],
		        [
		            "titulo" => "Historia universal",
		            "url" => $baseUrlCatalogos."6/historia"
		        ],
		        [
		            "titulo" => "Tecnología",
		            "url" => $baseUrlCatalogos."6/tecnologia"
		        ],
		        [
		            "titulo" => "Probabilidad y estadística",
		            "url" => $baseUrlCatalogos."6/probabilidad"
		        ]
		    ]
		];
		echo json_encode($libros_json);
	}
}
