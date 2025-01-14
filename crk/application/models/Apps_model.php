<?php
/*
	Se añadió a los queries lo siguiente:
	AND prefijo NOT LIKE 'fla_ing_%'
	para que no busque las actividades flash de la materia de Inglés

	Se añadió a los queries lo siguiente:
	AND prefijo NOT LIKE 'red_rm_%'
	para que no busque las actividades de Robotmaster
*/
class Apps_model extends CI_Model{
	public function getRealIP(){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])){
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
			return $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		return $_SERVER['REMOTE_ADDR'];
	}
	
	function consultaDemosG(){
		$query = "
			SELECT
			id_aplicacion,
			nombre,
			prefijo,
			SUBSTRING(REPLACE(objetivos, '-', '</li><li>*'),6, LENGTH(REPLACE(objetivos, '-', '</li><li>*'))) AS objetivos,
			CASE 
				WHEN categoria ='aplicacion'
					THEN 'app'
				WHEN categoria ='aplicacionL'
					THEN 'appL'
				ELSE
					categoria
			END
			AS categoria,
			CASE SUBSTRING(prefijo, 1, 3)
				WHEN 'hab'
					THEN SUBSTRING(prefijo, 8, 1)
				ELSE
					SUBSTRING(prefijo, 9, 1)
			END
			AS grado
			FROM aplicacion WHERE prefijo IN(
				'red_nat_5504e',
				'hab_rv_2043',
				'mdt_mat_6101',
				'red_his_5102b',
				'red_his_5104b',
				'red_esp_2901b',
				'red_art_7108b',
				'red_mat_5435a,'
				'des_mat_6106',
				'red_his_5215a',
				'red_esp_1911b',
				'hab_bp_1608a',
				'red_esp_7302h',
				'red_art_7103a',
				'red_bio_7102b',
				'red_mat_4102c1',
				'mdt_mat_5220',
				'red_bio_7101e',
				'red_bio_7101l',
				'red_geo_5101b',
				'red_his_6203b',
				'red_inf_7906c',
				'red_esp_7101d',
				'red_bio_7104h',
				'red_bio_7203c',
				'red_bio_7902c',
				'red_his_7091a'
			)
		";
		$result = $this->db->query($query);
		return $result;
	}
	
	function consultaDemosGLat(){
		$query = "
			SELECT
			id_aplicacion,
			nombre,
			prefijo,
			SUBSTRING(REPLACE(objetivos, '-', '</li><li>*'),6, LENGTH(REPLACE(objetivos, '-', '</li><li>*'))) AS objetivos,
			CASE 
				WHEN categoria ='aplicacion'
					THEN 'app'
				WHEN categoria ='aplicacionL'
					THEN 'appL'
				ELSE
					categoria
			END
			AS categoria,
			CASE SUBSTRING(prefijo, 1, 3)
				WHEN 'hab'
					THEN SUBSTRING(prefijo, 8, 1)
				ELSE
					SUBSTRING(prefijo, 9, 1)
			END
			AS grado
			FROM aplicacion WHERE prefijo IN(
				'red_nat_5504e',
				'hab_rv_2043',
				'red_geo_5305a',
				'col_cye_4901b',
				'col_his_5901b',
				'red_his_6601a',
				'per_geo_4901b',
				'red_his_6305a',
				'bol_geo_4902c',
				'red_esp_2901b',
				'red_art_7108b',
				'red_mat_5435a,'
				'des_mat_6106',
				'red_esp_1911b',
				'hab_bp_1608a',
				'red_esp_7302h',
				'red_art_7103a',
				'red_bio_7102b',
				'red_mat_4102c1',
				'mdt_mat_5220',
				'red_bio_7101e',
				'red_bio_7101l',
				'red_geo_5101b',
				'red_his_6203b',
				'red_inf_7906c',
				'red_esp_7101d',
				'red_bio_7104h',
				'red_bio_7203c',
				'red_bio_7902c',
				'red_his_7091a'
			)
		";
		$result = $this->db->query($query);
		return $result;
	}
	
	//Para obtener las aplicaciones de sinaloa
	function consultaSinaloa($type=""){
		
		//Para saber si enviamos las aplicaciones de Sinaloa o las de Adicciones
		if($type == 1){
			$pre = '%inaloa%';
		}else{
			$pre = '%dicciones%';
		}
		
		
		$query = "
			SELECT
			id_aplicacion,
			nombre,
			prefijo,
			SUBSTRING(REPLACE(objetivos, '-', '</li><li>*'),6, LENGTH(REPLACE(objetivos, '-', '</li><li>*'))) AS objetivos,
			CASE 
				WHEN categoria ='aplicacion'
					THEN 'app'
				WHEN categoria ='aplicacionL'
					THEN 'appL'
				ELSE
					categoria
			END as categoria
			
			FROM aplicacion WHERE palabras_clave LIKE '".$pre."' AND prefijo <> 'red_geo_3101o' ORDER BY id_aplicacion DESC";
			
		$result = $this->db->query($query);
		return $result;
	}
	
	function guardaLogApp($data){
		$db_krismare = $this->load->database('krismare', TRUE);
		$url = "";
		if($data['accion'] == "View app"){	
			$url = $this->config->item('krismar_apps_url')."index.php/recurso/cargarApp/".$data['id']."/primaria";	
		}
		if($this->session->userdata('user_id') != NULL){
			$query = "
				INSERT INTO primaria_log(
					time, 
					userid, 
					ip, 
					course, 
					module, 
					cmid, 
					action, 
					url, 
					info, 
					dispositivo
				)
				VALUES(
					".time().", 
					".$this->session->userdata('user_id') .",
					'".$this->getRealIP()."', 
					NULL, 
					NULL, 
					NULL, 
					'".$data['accion']."', 
					'".$url."', 
					'".$data['info']."', 
					'".$data['dispositivo']."'
				)
			";		
		}else {
			$query = "
				INSERT INTO primaria_log(
					time,
					userid,
					ip,
					course,
					module,
					cmid,
					action,
					url,
					info,
					dispositivo
				)
				VALUES(
					".time().",
					 1 ,
					'".$this->getRealIP()."', 
					NULL, 
					NULL, 
					NULL, 
					'".$data['accion']."', 
					'".$url."', 
					'".$data['info']."', 
					'".$data['dispositivo']."' 
				)
			";
		}
		$db_krismare->query($query);
	}
	
	function obtener_app_individual($prefijo){
		$query = "
			SELECT * FROM  aplicacion
			WHERE prefijo = '".$prefijo."'
		";
		$result = $this->db->query($query);
		if($result->num_rows() > 0){
			return $result->result();	
		}else {
			return null;
		}
	}
	
	function getAllAppsSection($portal, $demo){
		$query = "
			SELECT 
			app.id_aplicacion,
			app.nombre,
			SUBSTRING(REPLACE(app.objetivos, '-', '</li><li>*'),6, LENGTH(REPLACE(app.objetivos, '-', '</li><li>*'))) AS objetivos,
			app.prefijo,
			CASE 
				WHEN app.categoria ='aplicacion'
					THEN 'app'
				WHEN app.categoria ='aplicacionL'
					THEN 'appL'
				ELSE
					app.categoria
			END
			AS categoria
			FROM aplicacion app
			JOIN configuracion_app cap
				ON cap.prefijo = app.prefijo 
			AND portal = $portal
			AND tipo_demo = $demo
			ORDER BY cap.numero_orden;
		";
		$result = $this->db->query($query);
		return  $result;
	}
	
	function apps_conoce($data){
		$query = "
			SELECT
			ca.*,
			app.id_aplicacion,
			app.nombre,
			app.objetivos,
			app.categoria
			FROM
			configuracion_app ca,
			aplicacion app
			WHERE tipo_demo = 0
			AND app.prefijo = ca.prefijo
			ORDER BY numero_orden
			LIMIT ".$data['inicio'].", ".$data['fin']."
		";
		$queryTotal = "
			SELECT * FROM configuracion_app
			WHERE tipo_demo = 0
			ORDER BY numero_orden
		";
		$result = $this->db->query($query);
		$resultTotal = $this->db->query($queryTotal);
		$res['apps'] = $result->result();
		$res['total'] = $resultTotal->num_rows();
		return $res;
	}

	function consultaAppSinCurso($data){
		$condicionMovil = "";
		$condicionCategoria = "";
		$condicionGrado = "";
		$condicionMateria = "";
		$condicionTema = "";
		$condicionInput = "";
		$condicionMovilSep = "";
		$condicionCategoriaSep = "";
		$condicionGradoSep = "";
		$condicionMateriaSep = "";
		$condicionTemaSep = "";
		$condicionInputSep = "";
		$condicionLecturas = "
			AND g.nombre NOT LIKE '%lec%'
		";

		$filtroPrefijos="
			AND prefijo NOT LIKE '%red_rob%' 
			AND prefijo NOT LIKE '%red_pdc%' 
			AND prefijo NOT LIKE '%fls%' 
			AND prefijo NOT LIKE '%bra%'
			AND prefijo NOT LIKE 'red_pla%'
			AND prefijo NOT LIKE 'fla_geo_4901%'
			AND prefijo NOT LIKE 'fla_his_4901%'
			AND prefijo NOT LIKE 'fla_ing_%'
			AND prefijo NOT LIKE 'red_rm_%'
		";
		
		//Condición para dispositivo
		if($data['filtros']['dispositivo'] == 0){
			$condicionMovil = "
				AND app.prefijo NOT LIKE 'fla_%'
			";
		}
		//Condición para categoria
		if(isset($data['filtros']['categoria'])){
			if($data['filtros']['categoria'] == 'aplicacion'){
				$condicionCategoria = "
					AND (app.categoria = '".$data['filtros']['categoria']."'
					OR app.categoria = 'aplicacionL')
				";
			}else if($data['filtros']['categoria'] == 'evaluacion'){
				$condicionCategoria = "
					AND app.categoria LIKE '%".$data['filtros']['categoria']."%'
				";
			}else{
				$condicionCategoria = "
					AND app.categoria = '".$data['filtros']['categoria']."'
				";
			}
		}
		//Condición para grados
		if(isset($data['filtros']['grado'])){
			$condicionGrado = "
				AND b.nombre LIKE '%".$data['filtros']['grado']."%'
			";
		}
		//Condición para materia
		if(isset($data['filtros']['materia'])){
			$condicionMateria = "
				AND g.nombre LIKE '%".$data['filtros']['materia']."%'
			";
			if($data['filtros']['materia'] == 'lec'){
				$condicionLecturas = "";
			}
		}
		//Condición para tema
		if(isset($data['filtros']['tema'])){
			$condicionTema = "
				AND m.nombre LIKE '%".$data['filtros']['tema']."%'
			";
		}
		//Condición para texto en input
		if($data["palabrasCv"] != ""){
			$condicionInput = "
				AND (app.nombre LIKE '%".$data["palabrasCv"]."%'
				OR app.palabras_clave LIKE '%".$data["palabrasCv"]."%'
				OR app.prefijo LIKE '%".$data["palabrasCv"]."%')
			";
		}
		// Condiciones SEP
		//Condición para dispositivo
		if($data['filtros']['dispositivo'] == 0){
			$condicionMovilSep = "
				AND prefijo NOT LIKE 'fla_%'
			";
		}
		//Condición para categoria
		if(isset($data['filtros']['categoria'])){
			if($data['filtros']['categoria'] == 'aplicacion'){
				$condicionCategoriaSep = "
					AND (categoria = '".$data['filtros']['categoria']."' 
					OR categoria = 'aplicacionL')
				";
			}else if($data['filtros']['categoria'] == 'evaluacion'){
				$condicionCategoriaSep = "
					AND categoria LIKE '%".$data['filtros']['categoria']."%'
				";
			}else{
				$condicionCategoriaSep = "
					AND categoria = '".$data['filtros']['categoria']."'
				";
			}
		}
		//Condición para grados
		if(isset($data['filtros']['grado'])){
			$condicionGradoSep = "
				AND
				CASE SUBSTRING(prefijo, 1, 3)
					WHEN 'hab'
						THEN SUBSTRING(prefijo, 8, 1) = SUBSTRING('".$data['filtros']['grado']."', 1, 1)
					ELSE
						SUBSTRING(prefijo, 9, 1) = SUBSTRING('".$data['filtros']['grado']."', 1, 1)
				END
			";
		}
		//Condición para materia
		if(isset($data['filtros']['materia'])){
			$condicionMateriaSep = " 
				AND 
				CASE SUBSTRING(prefijo, 1, 3)
					WHEN 'hab'
						THEN SUBSTRING(prefijo, 1, 3) = '".$data['filtros']['materia']."'
					ELSE
						CASE '".$data['filtros']['materia']."'
							WHEN 'len'
								THEN SUBSTRING(prefijo, 5, 3) = 'esp'
							ELSE
								SUBSTRING(prefijo, 5, 3) = '".$data['filtros']['materia']."'
						END
				END
			";
		}
		//Condición para tema
		if(isset($data['filtros']['tema'])){
			$condicionTemaSep = "
				AND 
				CASE SUBSTRING(prefijo, 5, 2)
					WHEN 'rm' 
						THEN 'R Matemático'
					WHEN 'rV' 
						THEN 'R Verbal'
					WHEN 'bp' 
						THEN 'B del pens.'
				END 
				LIKE '%".$data['filtros']['tema']."%'
			";
		}
		//Condición para texto en input
		if(($data["palabrasCv"]) != ""){
			$condicionInputSep = "
				AND (nombre LIKE '%".$data["palabrasCv"]."%'
				OR palabras_clave LIKE '%".$data["palabrasCv"]."%'
				OR prefijo LIKE '%".$data["palabrasCv"]."%')
			";
		}

		$query = "
			SELECT DISTINCT
			app.id_aplicacion,
			app.nombre,
			app.prefijo,
			app.instrucciones,
			app.objetivos,
			app.palabras_clave,
			app.categoria
			FROM curso c
			JOIN grado g
				ON(c.id_curso=g.id_curso)
			JOIN materia m
				ON(g.id_grado=m.id_grado)
			JOIN bloque b
				ON(m.id_materia=b.id_materia)
			JOIN leccion l
				ON(b.id_bloque=l.id_bloque)
			JOIN curso_app ca
				ON(l.id_leccion=ca.id_leccion)
			JOIN aplicacion app
				ON(ca.id_aplicacion=app.id_aplicacion)
			WHERE c.id_curso=34
			".$filtroPrefijos."
			".$condicionInput."
			".$condicionMovil."
			".$condicionCategoria."
			".$condicionGrado."
			".$condicionMateria."
			".$condicionTema."
			".$condicionLecturas."
			ORDER BY l.id_bloque, ca.id_leccion, CAST(SUBSTRING(ca.seguimiento, 20, 10) AS UNSIGNED)
			LIMIT ".$data["inicio"].", ".$data["fin"]."
		";
		
		$consultaSinCurso = "
			SELECT DISTINCT
			id_aplicacion,
			nombre,
			prefijo,
			instrucciones,
			objetivos,
			palabras_clave,
			categoria
			FROM aplicacion WHERE aprobada = 1 
			".$filtroPrefijos."
			AND SUBSTRING(prefijo,9,1) < 7
			".$condicionInputSep."
			".$condicionMovilSep."
			".$condicionCategoriaSep."
			".$condicionMateriaSep."
			".$condicionTemaSep."
			".$condicionGradoSep."
			AND id_aplicacion NOT IN (
				SELECT distinct app.id_aplicacion
				FROM curso c
				JOIN grado g
					ON(c.id_curso=g.id_curso)
				JOIN materia m
					ON(g.id_grado=m.id_grado)
				JOIN bloque b
					ON(m.id_materia=b.id_materia)
				JOIN leccion l
					ON(b.id_bloque=l.id_bloque)
				JOIN curso_app ca
					ON(l.id_leccion=ca.id_leccion)
				JOIN aplicacion app
					ON(ca.id_aplicacion=app.id_aplicacion)
				WHERE c.id_curso=34
			)
			ORDER BY SUBSTRING(prefijo, 4, 20) DESC
		";

		$queryTotal = "
			SELECT DISTINCT
			app.id_aplicacion,
			app.nombre,
			app.prefijo,
			app.instrucciones,
			app.objetivos,
			app.palabras_clave,
			app.categoria
			FROM curso c
			JOIN grado g
				ON(c.id_curso=g.id_curso)
			JOIN materia m
				ON(g.id_grado=m.id_grado)
			JOIN bloque b
				ON(m.id_materia=b.id_materia)
			JOIN leccion l
				ON(b.id_bloque=l.id_bloque)
			JOIN curso_app ca
				ON(l.id_leccion=ca.id_leccion)
			JOIN aplicacion app
				ON(ca.id_aplicacion=app.id_aplicacion)
			WHERE c.id_curso=34
			".$filtroPrefijos."
			".$condicionInput."
			".$condicionMovil."
			".$condicionCategoria."
			".$condicionGrado."
			".$condicionMateria."
			".$condicionTema."
			".$condicionLecturas."
		";			
		$totalApps = $this->db->query($queryTotal);
		$apps = $this->db->query($query);
		$res['total'] = $totalApps->num_rows();
		$res['apps'] =  array_reverse($apps->result());
		if((($data['appsPorPagina'] + 3) * $data['fin']) >= $res['total']){
			//Llegó a la ultima seccion
			$apps_sincurso = $this->db->query($consultaSinCurso);
			$apps_sincursoar = $apps_sincurso->result();
			//Si no hay apps sin curso finaliza y retorna las mismas apps
			//En caso contrario comienza algoritmo para mostrar apps sin curso
			if($apps_sincurso->num_rows() == 0){
				return $res;
			}
			$numApps = ($data['pagActual'] * $data['fin']);
			//Las aplicaciones al final del array son las que primero se mostrarán
			if($numApps < $res['total']){
				$res['total'] = $totalApps->num_rows() + $apps_sincurso->num_rows();
				return $res;
			}
			if(sizeof($apps_sincursoar) < ($numApps-$res['total'])){
				array_splice($apps_sincursoar,((sizeof($apps_sincursoar)) - ((($data['pagActual']-1) * $data['fin'])-$res['total'])),((($data['pagActual']-1) * $data['fin'])-$res['total']) );
			}else{	
				array_splice($apps_sincursoar,0, sizeof($apps_sincursoar) - ($numApps-$res['total']));
			}
			if(sizeof($apps_sincursoar) >= $data['fin']){
				array_splice($apps_sincursoar,$data['fin'] , sizeof($apps_sincursoar));
			}
			$res['apps'] = array_merge($apps_sincursoar, $res['apps']);
			$res['total'] = $totalApps->num_rows() + $apps_sincurso->num_rows();
			return $res;	
		} else{
			return $res;
		}
	}
	
	function ConsultaAppSeparada($data){
		$condicionMovil = "";
		$condicionCategoria = "";
		$condicionGrado = "";
		$condicionMateria = "";
		$condicionTema = "";
		$condicionInput = "";
		//Condición para dispositivo
		if($data['isMovil'] == 0){
			$condicionMovil = "
				AND app.prefijo NOT LIKE 'fla_%'
			";
		}
		//Condición para categoria
		if(isset($data['filtros']['categoria'])){
			$condicionCategoria = "
				AND app.categoria = '".$data['filtros']['categoria']."'
			";
		}
		//Condición para grados
		if(isset($data['filtros']['grado'])){
			$condicionGrado = "
				AND b.nombre = '".$data['filtros']['grado']."'
			";
		}
		//Condición para materia
		if(isset($data['filtros']['materia'])){
			$condicionMateria = "
				AND g.nombre LIKE '%".$data['filtros']['materia']."%'
			";
		}
		//Condición para tema
		if(isset($data['filtros']['tema'])){
			$condicionTema = "
				AND m.nombre LIKE '%".$data['filtros']['tema']."%'
			";
		}
		//Condición para texto en input
		if(isset($data["palabrasCv"])){
			$condicionInput = "
				AND (app.nombre LIKE '%".$data["palabrasCv"]."%'
				OR app.palabras_clave LIKE '%".$data["palabrasCv"]."%'
				OR app.prefijo LIKE '%".$data["palabrasCv"]."%')
			";
		}
		$query = "
			SELECT
			app.id_aplicacion,
			app.nombre, app.prefijo,
			app.instrucciones,
			app.objetivos,
			app.palabras_clave,
			app.categoria,
			app.aprobada,
			ca.seguimiento,
			b.nombre as nombreg,
			m.nombre as nombret,
			g.nombre as nombrem
			FROM curso c
			JOIN grado g
				ON(c.id_curso=g.id_curso)
			JOIN materia m
				ON(g.id_grado=m.id_grado)
			JOIN bloque b
				ON(m.id_materia=b.id_materia)
			JOIN leccion l
				ON(b.id_bloque=l.id_bloque)
			JOIN curso_app ca
				ON(l.id_leccion=ca.id_leccion)
			JOIN aplicacion app
				ON(ca.id_aplicacion=app.id_aplicacion)
			WHERE c.id_curso=34
			".$condicionInput."
			".$condicionMovil."
			".$condicionCategoria."
			".$condicionGrado."
			".$condicionMateria."
			".$condicionTema."
			GROUP BY app.prefijo
			ORDER BY SUBSTRING(app.prefijo, 4, 20)
			LIMIT ".$data["inicio"].", ".$data["fin"]."
		";
		$queryTotal = "
			SELECT count(*) as total
			FROM curso c
			JOIN grado g
				ON(c.id_curso=g.id_curso)
			JOIN materia m
				ON(g.id_grado=m.id_grado)
			JOIN bloque b
				ON(m.id_materia=b.id_materia)
			JOIN leccion l
				ON(b.id_bloque=l.id_bloque)
			JOIN curso_app ca
				ON(l.id_leccion=ca.id_leccion)
			JOIN aplicacion app
				ON(ca.id_aplicacion=app.id_aplicacion)
			WHERE c.id_curso=34 
			".$condicionInput."
			".$condicionMovil."
			".$condicionCategoria."
			".$condicionGrado."
			".$condicionMateria."
			".$condicionTema."
			GROUP BY app.prefijo
		";
		$totalApps = $this->db->query($queryTotal);
		$apps = $this->db->query($query);
		$res['total'] = $totalApps->num_rows();
		$res['apps'] =  array_reverse($apps->result());
		return $res;
	}
}