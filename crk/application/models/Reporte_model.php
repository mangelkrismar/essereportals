<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte_model extends CI_Model {

	public function getAppsSinCurso(){
		$query = "
			SELECT
			app.fecha         AS f,
			app.id_aplicacion AS i,
			app.prefijo       AS p,
			app.nombre        AS n
			FROM view1a_aprobadas_sin_curso app
			WHERE app.prefijo NOT LIKE 'red_pla%'
			AND app.aprobada =1 
		;";
		
		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function getCursosMDT(){
		$query = "
			SELECT
				mdt.id_curso             AS i,
				mdt.curso                AS n,
                COUNT(mdt.id_aplicacion) AS t,
				mdt.curso_desc           AS d

			FROM
				view0a_cursos_mdt mdt

			GROUP BY
				mdt.id_curso
		;";

		$result = $this->db->query($query);
		return $result->result_array();
	}

	public function getCursoMDT($id_curso){
		$query = "
			SELECT
				mdt.grado          AS g,
				mdt.materia        AS m,
				mdt.bloque         AS b,
				mdt.leccion        AS l,
				mdt.prefijo        AS p,
				mdt.id_aplicacion  AS i,
				mdt.nombre         AS n,
				mdt.categoria      AS c,
				mdt.palabras_clave AS pc
			
			FROM view0a_cursos_mdt mdt
			WHERE id_curso = $id_curso
		;";

		$result = $this->db->query($query);
		return $result->result_array();
	}

}

/* End of file Reporte_model.php */
/* Location: ./application/models/Reporte_model.php */