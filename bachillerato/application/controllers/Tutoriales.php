 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tutoriales extends MY_Controller
{	
	public function index()
    {
    	$a = array(
			'1' => array(
				array(
					'titulo' => 'Novaschool - Google Classroom: Requisitos',
					'url'    => 'https://www.youtube.com/watch?v=qjX880a4sPk'
				),
				array(
					'titulo' => 'Novaschool - Google Classroom: Asignación de tareas',
					'url'    => 'https://www.youtube.com/watch?v=E4t_d8kA7fE'
				),
				array(
					'titulo' => 'Novaschool - Google Classroom: Responder tareas',
					'url'    => 'https://www.youtube.com/watch?v=C2jho6cBo6w'
				),
				array(
					'titulo' => 'Novaschool - Google Classroom: Reporte para profesor',
					'url'    => 'https://www.youtube.com/watch?v=D3rxrWzbkGo'
				)
			)
		);
		echo json_encode($a);
    }
}
