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
					'titulo' => 'Un libro sin recetas, para la maestra y el maestro. Fase 3.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1LPM.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1MLA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos de Aula.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1PAA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos Comunitarios.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1PCA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos escolares.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1PEA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes: Libro para alumnos, maestros y familia.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1SDA.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes. Trazos y palabras.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1TPA.htm'
				)
			),
			'2' => array(
				array(
					'titulo' => 'Un libro sin recetas, para la maestra y el maestro. Fase 3.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P1LPM.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P2MLA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos de Aula.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P2PAA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos Comunitarios.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P2PCA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos escolares.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P2PEA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes: Libro para alumnos, maestros y familia.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P2SDA.htm'
				)
			),
			'3' => array(
				array(
					'titulo' => 'Un libro sin recetas, para la maestra y el maestro. Fase 4.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3LPM.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3MLA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos de Aula.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3PAA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos Comunitarios.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3PCA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos escolares.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3PEA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes: Libro para alumnos, maestros y familia.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3SDA.htm'
				)
			),
			'4' => array(
				array(
					'titulo' => 'Un libro sin recetas, para la maestra y el maestro. Fase 4.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P3LPM.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P4MLA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos de aula.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P4PAA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos comunitarios.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P4PCA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos escolares.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P4PEA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes: Libro para alumnos, maestros y familia.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P4SDA.htm'
				),
				array(
					'titulo' => 'Cartografía de México y el mundo.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P0CMA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes México, Grandeza y diversidad. Multigrado.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P0SHA.htm'
				)
			),
			'5' => array(
				array(
					'titulo' => 'Un libro sin recetas, para la maestra y el maestro. Fase 5.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5LPM.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5MLA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos de Aula.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5PAA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos comunitarios.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5PCA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos escolares.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5PEA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes: Libro para alumnos, maestros y familia.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5SDA.htm'
				),
				array(
					'titulo' => 'Cartografía de México y el mundo.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P0CMA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes México, Grandeza y diversidad. Multigrado.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P0SHA.htm'
				)
			),
			'6' => array(
				array(
					'titulo' => 'Un libro sin recetas, para la maestra y el maestro. Fase 5.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P5LPM.htm'
				),
				array(
					'titulo' => 'Múltiples lenguajes.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P6MLA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos de Aula.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P6PAA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos Comunitarios.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P6PCA.htm'
				),
				array(
					'titulo' => 'Libro de proyectos escolares.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P6PEA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes: Libro para alumnos, maestros y familia.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P6SDA.htm'
				),
				array(
					'titulo' => 'Cartografía de México y el mundo.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P0CMA.htm'
				),
				array(
					'titulo' => 'Nuestros saberes México, Grandeza y diversidad. Multigrado.',
					'url'    => 'https://libros.conaliteg.gob.mx/2023/P0SHA.htm'
				)
			)
		);
		echo json_encode($a);
	}
}