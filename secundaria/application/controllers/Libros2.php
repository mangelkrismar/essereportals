<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Libros2 extends MY_Controller {
    public function libros(){
        $baseURLlibros = "http://localhost:8082/public/Libros/librosConaliteg/secundaria/";
        $libros_json = [
            "1" => [
                [
                    "titulo" => "Ética, naturaleza y sociedades",
                    "url" => $baseURLlibros."1/naturaleza"
                ],
                [
                    "titulo" => "De lo humano y lo comunitario",
                    "url" => $baseURLlibros."1/comunitario"
                ],
                [
                    "titulo" => "Lenguajes",
                    "url" => $baseURLlibros."1/lenguaje"
                ],
                [
                    "titulo" => "Múltiples lenguajes",
                    "url" => $baseURLlibros."1/mlenguaje"
                ],
                [
                    "titulo" => "Un libro sin recetas para la maestra y el maestro",
                    "url" => $baseURLlibros."1/docente"
                ],
                [
                    "titulo" => "Nuestro libro de proyectos. T1",
                    "url" => $baseURLlibros."1/proyectos1"
                ],
                [
                    "titulo" => "Nuestro libro de proyectos. T2",
                    "url" => $baseURLlibros."1/proyectos2"
                ],
                [
                    "titulo" => "Nuestro libro de proyectos. T3",
                    "url" => $baseURLlibros."1/proyectos3"
                ],
                [
                    "titulo" => "Saberes y pensamiento científico",
                    "url" => $baseURLlibros."1/ciencias"
                ]
            ],
            "2" => [
                [
                    "titulo" => "Física",
                    "url" => $baseURLlibros."2/fisica"
                ],
                [
                    "titulo" => "Física. Libro para el maestro",
                    "url" => $baseURLlibros."2/fisicam"
                ],
                [
                    "titulo" => "Español",
                    "url" => $baseURLlibros."2/espanol"
                ],
                [
                    "titulo" => "Español. Libro para el maestro",
                    "url" => $baseURLlibros."2/espanolm"
                ],
                [
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."2/civica"
                ],
                [
                    "titulo" => "Formación cívica y ética. Libro para el maestro",
                    "url" => $baseURLlibros."2/civicam"
                ],
                [
                    "titulo" => "Historia",
                    "url" => $baseURLlibros."2/historia"
                ],
                [
                    "titulo" => "Historia. Libro para el maestro",
                    "url" => $baseURLlibros."2/historiam"
                ],
                [
                    "titulo" => "Matemáticas",
                    "url" => $baseURLlibros."2/matematicas"
                ],
                [
                    "titulo" => "Matemáticas. Libro para el maestro",
                    "url" => $baseURLlibros."2/matematicasm"
                ]
            ],
            "3" => [
                [
                    "titulo" => "Historia",
                    "url" => $baseURLlibros."3/historia"
                ],
                [
                    "titulo" => "Historia. Libro para el maestro",
                    "url" => $baseURLlibros."3/historiam"
                ],
                [
                    "titulo" => "Español",
                    "url" => $baseURLlibros."3/espanol"
                ],
                [
                    "titulo" => "Español. Libro para el maestro",
                    "url" => $baseURLlibros."3/espanolm"
                ],
                [
                    "titulo" => "Formación cívica y ética",
                    "url" => $baseURLlibros."3/civica"
                ],
                [
                    "titulo" => "Formación cívica y ética. Libro para el maestro",
                    "url" => $baseURLlibros."3/civicam"
                ],
                [
                    "titulo" => "Matemáticas",
                    "url" => $baseURLlibros."3/matematicas"
                ],
                [
                    "titulo" => "Matemáticas. Libro para el maestro",
                    "url" => $baseURLlibros."3/matematicasm"
                ],
                [
                    "titulo" => "Química",
                    "url" => $baseURLlibros."3/quimica"
                ],
                [
                    "titulo" => "Química. Libro para el maestro",
                    "url" => $baseURLlibros."3/quimicam"
                ]
            ]
        ];
        echo json_encode($libros_json);
    }

	public function librosMaestro(){
		$libros_json='{
			"1":[
		        {
		            "titulo":"Biología",
		            "url":"../secundaria_libros/librosMaestro/g1/Biologia.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"../secundaria_libros/librosMaestro/g1/Civica.pdf"
		        },
		        {
		            "titulo":"Geografía",
		            "url":"../secundaria_libros/librosMaestro/g1/Geografia.pdf"
		        },
		        {
		            "titulo":"Historia",
		            "url":"../secundaria_libros/librosMaestro/g1/Historia.pdf"
		        },
		        {
		            "titulo":"Lenguaje y comunicación",
		            "url":"../secundaria_libros/librosMaestro/g1/Espanol.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"../secundaria_libros/librosMaestro/g1/Matematicas.pdf"
		        }
		    ],
		    "2":[
		        {
		            "titulo":"Física",
		            "url":"../secundaria_libros/librosMaestro/g2/Fisica.pdf"
		        },
		        {
		            "titulo":"Formación cívica y ética",
		            "url":"../secundaria_libros/librosMaestro/g2/Civica.pdf"
		        },
		        {
		            "titulo":"Historia",
		            "url":"../secundaria_libros/librosMaestro/g2/Historia.pdf"
		        },
		        {
		            "titulo":"Lenguaje y comunicación",
		            "url":"../secundaria_libros/librosMaestro/g2/Espanol.pdf"
		        },
		        {
		            "titulo":"Matemáticas",
		            "url":"../secundaria_libros/librosMaestro/g2/Matematicas.pdf"
		        }
		    ]
		}';
		echo $libros_json;
	}

	public function catalogos(){
		$baseURLcatalogos = "http://localhost:8082/public/Catalogos/secundaria/";
		$libros_json=[
			"1" => [
		        [
		            "titulo" => "Biología.",
		            "url" => $baseURLcatalogos."1/biologia"
		        ],
		        [
		            "titulo" => "Convivencia y ciudadanía",
		            "url" => $baseURLcatalogos."1/civica"
		        ],
		        [
		            "titulo" => "Expresión artística",
		            "url" => $baseURLcatalogos."1/educacionArtistica"
		        ],
		        [
		            "titulo" => "Lenguaje y comunicación",
		            "url" => $baseURLcatalogos."1/espanol"
		        ],
		        [
		            "titulo" => "Geografía",
		            "url" => $baseURLcatalogos."1/geografia"
		        ],
		        [
		            "titulo" => "Historia",
		            "url" => $baseURLcatalogos."1/historia"
		        ],
		        [
		            "titulo" => "Habilidades digitales",
		            "url" => $baseURLcatalogos."1/informatica"
		        ],
		        [
		            "titulo" => "Pensamiento Matemático",
		            "url" => $baseURLcatalogos."1/matematicas"
		        ]
		    ],
		    "2" => [
		        [
		            "titulo" => "Física",
		            "url" => $baseURLcatalogos."2/fisica"
		        ],
		        [
		            "titulo" => "Convivencia y ciudadanía",
		            "url" => $baseURLcatalogos."2/civica"
		        ],
		        [
		            "titulo" => "Expresión artística",
		            "url" => $baseURLcatalogos."2/educacionArtistica"
		        ],
		        [
		            "titulo" => "Lenguaje y comunicación",
		            "url" => $baseURLcatalogos."2/espanol"
		        ],
		        [
		            "titulo" => "Historia",
		            "url" => $baseURLcatalogos."2/historia"
		        ],
		        [
		            "titulo" => "Habilidades digitales",
		            "url" => $baseURLcatalogos."2/informatica"
		        ],
		        [
		            "titulo" => "Pensamiento Matemático",
		            "url" => $baseURLcatalogos."2/matematicas"
		        ]
		    ],
		    "3" => [
		        [
		            "titulo" => "Convivencia y ciudadanía",
		            "url" => $baseURLcatalogos."3/civica"
		        ],
		        [
		            "titulo" => "Expresión artística",
		            "url" => $baseURLcatalogos."3/educacionArtistica"
		        ],
		        [
		            "titulo" => "Lenguaje y comunicación",
		            "url" => $baseURLcatalogos."3/espanol"
		        ],
		        [
		            "titulo" => "Historia",
		            "url" => $baseURLcatalogos."3/historia"
		        ],
		        [
		            "titulo" => "Habilidades digitales",
		            "url" => $baseURLcatalogos."3/informatica"
		        ],
		        [
		            "titulo" => "Pensamiento Matemático",
		            "url" => $baseURLcatalogos."3/matematicas"
		        ],
		        [
		            "titulo" => "Química",
		            "url" => $baseURLcatalogos."3/quimica"
		        ]
		    ]
		];
		echo json_encode($libros_json);
	}

	public function secundaria(){
		$libros_json='{
			"1":[
		        {
		            "titulo":"Biología - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00382.htm"
		        },
		        {
		            "titulo":"Biología - Santillana",
		            "url":"https://www.santillanacontigo.com.mx/libromedia/espacios-creativos/BiologiaA/mobile.html"
		        },
		        {
		            "titulo":"Cívica - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S15021.htm"
		        },
		        {
		            "titulo":"Cívica - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/170892"
		        },
		        {
		            "titulo":"Cívica - EK Editores",
		            "url":"http://ekeditores.com/S15012/"
		        },
		        {
		            "titulo":"Geografía - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/184292"
		        },
		        {
		            "titulo":"Geografía - Norma",
		            "url":"https://packgoogle-pro.s3.us-east-1.amazonaws.com/libromedia-norma/geografiaac2018/mobile.html"
		        },
		        {
		            "titulo":"Historia - Norma",
		            "url":"https://packgoogle-pro.s3.us-east-1.amazonaws.com/libromedia-norma/historia_del_mundo1ac2018/mobile.html"
		        },
		        {
		            "titulo":"Historia - Méndez Cortés",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00304.htm"
		        },
		        {
		            "titulo":"Historia - Patria",
		            "url":"https://digital.latiendadellibrero.com/pdfreader/historia-1-arce-para-1er-grado50170823"
		        },
		        {
		            "titulo":"Español - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/184286"
		        },
		        {
		            "titulo":"Español - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00393.htm"
		        },
		        {
		            "titulo":"Español - Edelvives",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00390.htm"
		        },
		        {
		            "titulo":"Matemáticas - Innova ediciones",
		            "url":"https://conaliteg.esfinge.mx/S00328_Matematicas_1_Innova_2021%20(Published)/"
		        },
                {
		            "titulo":"Matemáticas - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00341.htm"
		        }
		    ],
		    "2":[
		        {
		            "titulo":"Física - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00481.htm"
		        },
                {
		            "titulo":"Física - Ríos de tinta",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00479.htm"
		        },
                {
		            "titulo":"Física - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/170887"
		        },
                {
		            "titulo":"Cívica - Innova ediciones",
		            "url":"https://conaliteg.esfinge.mx/S15032_Formacion_Civica_Etica_2_InnovaT_2021%20(Published)/"
		        },
                {
		            "titulo":"Cívica - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/170893"
		        },
                {
		            "titulo":"Cívica - Editorial Esfinge",
		            "url":"https://conaliteg.esfinge.mx/S15033_Formacion_Civica_y_Etica_2_Saber_Ser_Esfinge_2021%20(Published)/"
		        },
                {
		            "titulo":"Historia - Norma",
		            "url":"https://packgoogle-pro.s3.amazonaws.com/libromedia-norma/historiademexico2aprenderyconvivir/mobile.html"
		        },
                {
		            "titulo":"Historia - Ríos de tinta",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S26051.htm"
		        },
                {
		            "titulo":"Historia - Terracota",
		            "url":"https://terradelibros.com/libros-de-texto-terracota-2020-2021/historia-2-s26052/"
		        },
                {
		            "titulo":"Español - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/170881"
		        },
                {
		            "titulo":"Español - Edelvives",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00468.htm"
		        },
                {
		            "titulo":"Matemáticas - Innova ediciones",
		            "url":"https://conaliteg.esfinge.mx/S00456_Matematicas_2_innovaT_2021%20(Published)/"
		        },
                {
		            "titulo":"Matemáticas - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00453.htm"
		        }
		    ],
		    "3":[
		        {
		            "titulo":"Química - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00030.htm"
		        },
                {
		            "titulo":"Química - Ríos de tinta",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00033.htm"
		        },
                {
		            "titulo":"Química - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/163307"
		        },
                {
		            "titulo":"Cívica - Innova ediciones",
		            "url":"https://conaliteg.esfinge.mx/S15041_Formacion_Civica_Etica_3_InnovaT_2021%20(Published)/"
		        },
                {
		            "titulo":"Cívica - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/184301"
		        },
                {
		            "titulo":"Cívica - Santillana",
		            "url":"https://www.santillanacontigo.com.mx/libromedia/espacios-creativos/cfc3-ec/mobile.html"
		        },
                {
		            "titulo":"Historia - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/206521"
		        },
                {
		            "titulo":"Historia - Santillana",
		            "url":"https://packgoogle-pro.s3.amazonaws.com/libromedia-santillana/santillanacontigo-conali/%20historia-3-fa-alu/mobile.html"
		        },
                {
		            "titulo":"Historia - Patria",
		            "url":"https://digital.latiendadellibrero.com/pdfreader/historia-350175939"
		        },
                {
		            "titulo":"Español - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/162359"
		        },
                {
		            "titulo":"Español - Ríos de tinta",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S00069.htm"
		        },
                {
		            "titulo":"Matemáticas - Ediciones SM",
		            "url":"https://guiasdigitales.grupo-sm.com.mx/sites/default/files/guias/206514"
		        },
                {
		            "titulo":"Matemáticas - Santillana",
		            "url":"https://packgoogle-pro.s3.amazonaws.com/libromedia-santillana/santillanacontigo-conali/matematicas-3-fa-alu/mobile.html"
		        },
                {
		            "titulo":"Matemáticas - Correo del maestro",
		            "url":"https://libros.conaliteg.gob.mx/2021/secundaria/S02007.htm"
		        }
		    ]
		}';
		echo $libros_json;
	}
}
