 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libros extends MY_Controller
{	
	function Libros(){
		parent::__construct();
	}

	public function index(){
		$baseURLlibros = "http://localhost:8082/public/Libros/librosConaliteg/preescolar/";
		$libros_json = [
			"1" => [
		        [
		            "titulo" => "Láminas didácticas",
		            "url" => $baseURLlibros."1/laminas"
		        ],
		        [
		            "titulo" => "Mi álbum",
		            "url" => $baseURLlibros."1/album"
		        ]
		    ],
		    "2" => [
		        [
		            "titulo" => "Láminas didácticas",
		            "url" => $baseURLlibros."2/laminas"
		        ],
		        [
		            "titulo" => "Mi álbum",
		            "url" => $baseURLlibros."2/album"
		        ]
		    ],
			"3" => [
		        [
		            "titulo" => "Láminas didácticas",
		            "url" => $baseURLlibros."3/laminas"
		        ],
		        [
		            "titulo" => "Mi álbum",
		            "url" => $baseURLlibros."3/album"
		        ]
		    ],
			"E" => [
		        [
		            "titulo" => "Los niños expresan valores. Justicia",
		            "url" => $baseURLlibros."E/justicia"
		        ],
		        [
		            "titulo" => "Los niños expresan valores. Respeto",
		            "url" => $baseURLlibros."E/respeto"
		        ],
		        [
		            "titulo" => "Los niños expresan valores. Honestidad",
		            "url" => $baseURLlibros."E/honestidad"
		        ],
		        [
		            "titulo" => "Libro de la educadora",
		            "url" => $baseURLlibros."E/educadora"
		        ],
		        [
		            "titulo" => "Libro para las familias. Educación preescolar",
		            "url" => $baseURLlibros."E/familias"
		        ]
		    ]
		];
		echo json_encode($libros_json);
	}
}
