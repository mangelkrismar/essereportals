 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libros extends MY_Controller
{	
	function Libros(){
		parent::__construct();
		
		//$this->load->model('Apps_model');
		//$this->load->model('Config_model');
	}
	public function index(){
		$libros_json='{
			"1":[
		        {
		            "titulo":"Desafíos matemáticos",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/1/Desafios_matematicos_1.pdf"
		        },
		        {
		            "titulo":"Lengua Materna. Español",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g1/espanol.pdf"
		        },
		        {
		            "titulo":"Lengua Materna. Español. Lecturas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g1/lecturas.pdf"
		        },
		        {
		            "titulo":"Conocimiento del medio",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g1/cienciasNaturales.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g1/matematicas.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g1/civica.pdf"
		        },
		        {
		            "titulo":"Material de apoyo a la alfabetización inicial",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g1/material.pdf"
		        }
		    ],
		    "2":[
		        {
		            "titulo":"Desafíos matemáticos",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/2/Desafios_matematicos_2.pdf"
		        },
		        {
		            "titulo":"Lengua Materna. Español",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g2/espanol.pdf"
		        },
		        {
		            "titulo":"Lengua Materna. Español. Lecturas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g2/lecturas.pdf"
		        },
		        {
		            "titulo":"Conocimiento del medio",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g2/cienciasNaturales.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g2/matematicas.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g2/civica.pdf"
		        }
		    ],
			"3":[
		        {
		            "titulo":"Ciencias Naturales",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/cienciasNaturales.pdf"
		        },
		        {
		            "titulo":"Desafíos matemáticos",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/desafiosMatematicos.pdf"
		        },
		        {
		            "titulo":"Educación Artística",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/educacionArtistica.pdf"
		        },
		        {
		            "titulo":"Español",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/espanol.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/civica.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/matematicas.pdf"
		        },
		        {
		            "titulo":"Lecturas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g3/lecturas.pdf"
		        },
				{
			    	"titulo":"La entidad donde vivo: Aguascalientes",
			    	"url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Aguascalientes_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Baja California",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Baja_California_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Baja California Sur",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Baja_California_Sur_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: CDMX",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/CDMX%20_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Campeche",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Campeche_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Chiapas",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Chiapas%20_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Chihuahua",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Chihuahua_%203%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Coahuila",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Coahuila_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Colima",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Colima_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Durango",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Durango_%203%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Estado de México",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Estado_de_Mexico.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Guanajuato",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Guanajuato_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Guerrero",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Guerrero_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Hidalgo",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Hidalgo_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Jalisco",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Jalisco_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Michoacán",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Michoacan.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Morelos",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Morelos_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Nayarit",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Nayarit_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Nuevo León",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Nuevo_leon.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Oaxaca",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Oaxaca_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Puebla",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Puebla_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Querétaro",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Queretaro.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Quintana Roo",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Quintana_Roo_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: San Luis Potosí",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/SLP_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Sinaloa",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Sinaloa_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Sonora",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Sonora_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Tabasco",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Tabasco_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Tamaulipas",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Tamaulipas_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Tlaxcala",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Tlaxcala_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Veracruz",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Veracruz_3%20grado.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Yucatán",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Yucatan.pdf"
			    },
			    {
			        "titulo":"La entidad donde vivo: Zacatecas",
			        "url":"https://www.krismar-educa.com.mx/primaria_libros/3/La%20entidad%20donde%20vivo/Zacatecas_3%20grado.pdf"
			    }
		    ],
		    "4":[
		        {
		            "titulo": "Atlas de México",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/atlas.pdf"
		        },
		        {
		            "titulo": "Ciencias naturales",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/cienciasNaturales.pdf"
		        },
		        {
		            "titulo": "Conoce nuestra Constitución",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/constitucion.pdf"
		        },
		        {
		            "titulo": "Desafíos matemáticos",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/desafiosMatematicos.pdf"
		        },
		        {
		            "titulo": "Educación Artística",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/educacionArtistica.pdf"
		        },
		        {
		            "titulo": "Español",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/espanol.pdf"
		        },
		        {
		            "titulo": "Lecturas",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/lecturas.pdf"
		        },
		        {
		            "titulo": "Formación cívica y ética",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/civica.pdf"
		        },
		        {
		            "titulo": "Geografía",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/geografia.pdf"
		        },
		        {
		            "titulo": "Historia",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/historia.pdf"
		        },
		        {
		            "titulo": "Matemáticas",
		            "url": "https://www.krismar-educa.com.mx/primaria_libros/libros/g4/matematicas.pdf"
		        }
		    ],
			"5":[
		        {
		            "titulo":"Atlas de geografía del mundo",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/atlas.pdf"
		        },
		        {
		            "titulo":"Ciencias Naturales",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/cienciasNaturales.pdf"
		        },
		        {
		            "titulo":"Desafíos matemáticos",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/desafiosMatematicos.pdf"
		        },
		        {
		            "titulo":"Educación Artística",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/educacionArtistica.pdf"
		        },
		        {
		            "titulo":"Español",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/espanol.pdf"
		        },
		        {
		            "titulo":"Lecturas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/lecturas.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/civica.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética. Cuaderno de aprendizaje",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/cacivica.pdf"
		        },
		        {
		            "titulo":"Geografía",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/geografia.pdf"
		        },
		        {
		            "titulo":"Historia",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/historia.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g5/matematicas.pdf"
		        }
		    ],
			"6":[
		        {
		            "titulo":"Ciencias Naturales",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/cienciasNaturales.pdf"
		        },
		        {
		            "titulo":"Desafíos matemáticos",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/desafiosMatematicos.pdf"
		        },
		        {
		            "titulo":"Educación Artística",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/educacionArtistica.pdf"
		        },
		        {
		            "titulo":"Español",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/espanol.pdf"
		        },
		        {
		            "titulo":"Lecturas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/lecturas.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/civica.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética. Cuaderno de aprendizaje",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/cacivica.pdf"
		        },
		        {
		            "titulo":"Geografía",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/geografia.pdf"
		        },
		        {
		            "titulo":"Historia",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/historia.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/matematicas.pdf"
		        },
		        {
		            "titulo":"Cuaderno de actividades. Geografía",
		            "url":"https://www.krismar-educa.com.mx/primaria_libros/libros/g6/cuadernoGeografia.pdf"
		        }
		    ]
		}';
		echo $libros_json;
	}
}
