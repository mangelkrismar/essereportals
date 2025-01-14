<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Classroom_model extends CI_MODEL{
	function guardaEnBase($tarea){
		/*
			* NOMBRE: guardaTarea.
			* UTILIDAD: Almacena una tarea compartida por un profesor en la DB
			* ENTRADAS: $tarea -> Parametros necesarios para insertar en DB un registro perteneciente a una tarea compartida.
			* SALIDAS: Ninguna.
		*/
		$db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "INSERT INTO gclass_clas VALUES('".$tarea['crID']."', '".$tarea['courseWorkID']."', '".$tarea['courseID']."', '".$tarea['creatorUserID']."', '".$tarea['creationTime']."', '".(isset($tarea['topicID'])?$tarea['topicID']:"null")."', '".$tarea['courseName']."', '".$tarea['courseWorkTitle']."', '".$tarea['profesor']."', '".$tarea['type']."', '".(isset($tarea['topic'])?$tarea['topic']:"null")."', '".json_encode($tarea['respuestas'])."', '".$tarea['dueDate']."', '".$tarea['dueTime']."', '".$tarea['maxPoint']."', '".$tarea['activityLink']."', CURDATE() )";
		
		return $db_connectionKris->query($query);
	}

	function guardaCalif($entrega){
		$db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "SELECT respuestas, maxPoint FROM gclass_clas WHERE crID = '".$entrega['crID']."'";
		error_log($query);
		$result = $db_connectionKris->query($query);
		setlocale(LC_TIME, "es_ES");
		$entregada = false;
		if($result->num_rows()>0){
			error_log("se encontro la tarea");
			$aux = $result->row_array()['respuestas'];
			$aux = json_decode($aux, true);
			for($i = 0; $i<count($aux);$i++){
				if($aux[$i]['idAlumno'] == $entrega['userID']){
					$datos['calif'] = $entrega['calif'];
					$datos['fechaEntrega'] = strftime("%a %d %B %Y, %H:%M");//date(DATE_RFC2822);
					array_push($aux[$i]['entregas'], $datos);
					$entregada = true;
					break;
				}
			}
			if(!$entregada){
				//ALUMNO NUEVO
				$alumno['idAlumno'] = $entrega['userID'];
				$alumno['nombreAlumno'] = $entrega['userName'];
				$entrega['calif'] = "";
				$entrega['fechaEntrega'] = "";
				array_push($alumno['entregas'], $entrega);
				$entrega['calif'] = $entrega['calif'];
				$entrega['fechaEntrega'] = strftime("%a %d %B %Y, %H:%M");
				array_push($alumno['entregas'], $entrega);
				array_push($aux,$alumno);
			}
			$query = "UPDATE gclass_clas SET respuestas = '".json_encode($aux)."' WHERE crID = '".$entrega['crID']."'";
			return $db_connectionKris->query($query);
		}
		error_log("no se encontro la tarea");
		return false;
	}

	function getClassWorkByCWorkID($id){
		$db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "SELECT * FROM gclass_clas WHERE courseWorkID = '".$id."'";
		$result = $db_connectionKris->query($query);

		if($result->num_rows()>0)
			return $result->row_array();
		return false;
	}

	function getEntregasByCourseWork($id){
		/*
            * NOMBRE: getEntregasByCourseWork.
            * UTILIDAD: Obtiene las entregas de una tarea en especifico.
            * ENTRADAS: $id -> ID de la tarea a obteber las entregas.
            * SALIDAS: Ninguna
        */
        $db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "SELECT respuestas FROM gclass_clas WHERE courseWorkID = '".$id."'";
		$result = $db_connectionKris->query($query);
		return $result->row_array()['respuestas'];
	}

	function getAllCourseWorks($courseID){
		/*
            * NOMBRE: getAllCourseWork.
            * UTILIDAD: Obtiene todas las tareas de un curso en la DB de Krismar, utilizando su ID.
            * ENTRADAS: $courseID -> ID del curso al del que se obtienen todas las tareas.
            * SALIDAS: $result -> Array de IDs de todas las tareas del curso.
        */
        $db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "SELECT courseWorkID FROM gclass_clas WHERE courseID = '".$courseID."';";
		$result = $db_connectionKris->query($query);
		return $result->result();
	}

	function deleteCourseWork($id){
		/*
            * NOMBRE: deleteCourseWork.
            * UTILIDAD: Elimina una tarea de la DB, utilizando su 'courseWorkID'.
            * ENTRADAS: $id -> ID de la tarea a eliminar.
            * SALIDAS: Ninguna.
        */
        $db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "DELETE  FROM gclass_clas WHERE courseWorkID = '".$id."';";
		$result = $db_connectionKris->query($query);
		return $result;
	}

	function updateAlumnos($idTarea, $respuestas){
		/*
            * NOMBRE: updateAlumnos.
            * UTILIDAD: Actualiza las respuestas de los alumnos en una tarea especifica, en caso de que se haya eliminado un alimno de classroom.
            * ENTRADAS: $idTarea -> ID de la tarea a actualizar, $respuestas -> Nuevo array de respuestas con la cantidad de alumnos que hay en classroom.
            * SALIDAS: Ninguna.
        */
        $db_connectionKris = $this->load->database('gclass', TRUE);
		$query = "UPDATE gclass_clas SET respuestas = '".json_encode($respuestas)."' WHERE courseWorkID = '".$idTarea."'";
		$result = $db_connectionKris->query($query);
	}
}

