<?php
class Config_model extends CI_Model
{
    
	function obtener_apps_total(){
        $consulta = "
        	SELECT
        	id_aplicacion,
        	nombre,
        	categoria,
        	prefijo,
        	palabras_clave,
        	objetivos,
        	instrucciones
        	FROM aplicacion
        	WHERE aprobada = 1 
        	and prefijo not like '%red_rob%'
        	and prefijo not like '%red_pdc%'
        	and prefijo not like '%fls%'
        	and prefijo not like '%bra%'
        	and prefijo not like '%pla%'
        	AND SUBSTRING(prefijo,9,1) < 7
        	ORDER BY prefijo
        ";

		$result = $this->db->query($consulta);

        if($result->num_rows() > 0){
            return $result;
        }else{
            return null;
        }
    }
	function obtener_apps(){
        $consulta = "
        	SELECT
        	id_aplicacion,
        	nombre, categoria,
        	prefijo,
        	palabras_clave,
        	objetivos,
        	instrucciones
        	FROM aplicacion
        	WHERE aprobada = 1 
        	and prefijo not like '%red_rob%'
        	and prefijo not like '%red_pdc%'
        	and prefijo not like '%fls%'
        	AND SUBSTRING(prefijo,9,1) < 7
        	ORDER BY prefijo
        ";

		$result = $this->db->query($consulta);

        if($result->num_rows() > 0){
            return $result;
        }else{
            return null;
        }
    }



    function obtener_edo($prefijo){
        $query = "
        	SELECT *
        	FROM configuracion_app
        	WHERE prefijo = '".$prefijo."'
        ";
        $result = $this->db->query($query);
        if($result->num_rows() > 0){//Hubo resultados
			return $result->row();
		}else{
			return null;
		}
    }

    function nueva_app($prefijo, $numero_orden, $tipo_demo)
    {
        $insert = "
        	INSERT INTO configuracion_app(
        		prefijo,
        		numero_orden,
        		tipo_demo
        	) VALUES (
        		'". $prefijo ."',
        		".$numero_orden.",
        		". $tipo_demo."
        	);
        ";
        $result = $this->db->query($insert);
    }

    function obtener_apps_demo($tipo_demo)
    {

        $query = "
        	SELECT *
        	FROM configuracion_app
        	WHERE tipo_demo = $tipo_demo
        	ORDER BY numero_orden
        ";
     
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            return $result;
        }else{
            return null;
        }
    }

    function existe_demo($prefijo ,$tipo_demo)
    {
        $query = "
        	SELECT *
        	FROM configuracion_app
        	WHERE prefijo = '".$prefijo."'
        	and tipo_demo = $tipo_demo;
        ";
        $result = $this->db->query($query);
        if($result->num_rows() > 0){
            return $result;
        }else{
            return null;
        }
    }


    function eliminar_apps($prefijo, $tipo_demo)
    {
        $query = "
        	DELETE FROM configuracion_app
        	WHERE prefijo = '". $prefijo . "'
        	AND tipo_demo = $tipo_demo;
        ";
        $this->db->query($query);
    }
	
    function modifica_demo($prefijo, $numero_orden, $tipo_demo){
		echo "Llego la app con el prefijo $prefijo y el numero orden es: " . $numero_orden;
        $query = "
        	UPDATE configuracion_app
        	SET numero_orden = $numero_orden
        	WHERE prefijo = '" . $prefijo . "'
        	AND tipo_demo = $tipo_demo;
        ";
        $this->db->query($query);
    }
	
	
	//Obtiene los grados del curso
	function getGrados($id_curso)
	{
		$consulta = "
			SELECT *
			FROM grado
			where id_curso=".$id_curso
		;
		$query=$this->db->query($consulta);
		return $query;	
	}
	//Obtiene las asignaturas de cada grado del curso
	function getAsignaturas($id_grado)
	{
		$consulta = "
			SELECT *
			FROM materia
			where id_grado=".$id_grado
		;
		$query=$this->db->query($consulta);
		return $query;	
	}
	//Obtiene los bloques de cada asignatura
	function getBloques($id_asignatura)
	{
		$consulta = "
			SELECT *
			FROM bloque
			where id_materia=".$id_asignatura
		;
		$query=$this->db->query($consulta);
		return $query;	
	}
	//Obtiene las lecciones de cada bloque
	function getLecciones($id_bloque)
	{
		$consulta = "
			SELECT *
			FROM leccion
			where id_bloque=".$id_bloque
		;
		$query=$this->db->query($consulta);
		return $query;
	}
	//Obtiene las apps de una leccion
	function getCurso_apps($id_leccion)
	{
		$consulta = "
			SELECT *
			FROM curso_app
			where id_leccion=".$id_leccion
		;
		$query=$this->db->query($consulta);
		return $query;
	}
	////////////////////////////////////////obtener curso respecto a usuario
	 
	function obtenerAppsCurso($curso){
		$consulta = "
			SELECT
			app.id_aplicacion,
			app.nombre,
			app.prefijo,
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
			on(c.id_curso=g.id_curso)
			JOIN materia m
			on(g.id_grado=m.id_grado)
			JOIN bloque b
			on(m.id_materia=b.id_materia)
			JOIN leccion l
			on(b.id_bloque=l.id_bloque)
			JOIN curso_app ca
			on(l.id_leccion=ca.id_leccion)
			JOIN aplicacion app
			on(ca.id_aplicacion=app.id_aplicacion)
			WHERE c.id_curso=".$curso
		;	 
		$query=$this->db->query($consulta);
		return $query;
	}

	
	
	
	
	function obtenerTemasMteria($idCurso){
		$sql = "
			SELECT
			g.nombre AS nombreMateria,
			m.nombre AS nombreTema 
			FROM grado g, materia m
			where g.id_grado = m.id_grado
			AND g.id_curso = $idCurso"
		;
		$query = $this->db->query($sql);
		return $query;
	}
	
	function obtenerDatosUser($idUser){
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query_dura = "SELECT * FROM mdl_user WHERE id = $idUser";
	
		$result = $db_krismare->query($query_dura);
		
		return $result;
	}

	function getPortalGradosJson($username = ''){
		$db_krismare = $this->load->database('krismare', TRUE);
		$query = "
			SELECT portal_grados_json FROM mdl_user
			WHERE username = '".$username."';
		";
		$result = $db_krismare->query($query);
		$result_array = $result->row_array();
		return $result_array['portal_grados_json'];
	}

	function actualizaPsw($pass){
		$username = $this->session->userdata('nombre');
		$user_pgj = $this->getPortalGradosJson($username);
		$qportal = $this->config->item('qportal');

		$pgj_arr = json_decode($user_pgj);

		$pgj_arr->{$qportal}->pwd = $pass;

		$user_pgj = json_encode($pgj_arr);

		$db_krismare = $this->load->database('krismare', TRUE);
		$query_dura = "
			UPDATE mdl_user
			SET portal_grados_json = '$user_pgj'
			WHERE username = '". $username."'
		";
		$result = $db_krismare->query($query_dura);
		return $result;
	}
	
	function guardaDatosUser($data){
		$db_krismare = $this->load->database('krismare', TRUE);
		if(isset($data['borraImg'])){
			$query_dura = "UPDATE mdl_user
					SET 
					firstname = '". $data['nombre'] ."', 
					lastname = '". $data['apellido'] ."', 
					email = '". $data['email'] ."',
					country = '". $data['pais'] ."',
					city = '". $data['ciudad'] ."',
					imagen = ''
			WHERE username = '". $this->session->userdata('nombre')."'";
		}else{
			if(isset($data['imagen'])){
				$query_dura = "UPDATE mdl_user
					SET 
					firstname = '". $data['nombre'] ."', 
					lastname = '". $data['apellido'] ."', 
					email = '". $data['email'] ."',
					country = '". $data['pais'] ."',
					city = '". $data['ciudad'] ."',
					imagen = '". $data['imagen'] ."'
					WHERE username = '". $this->session->userdata('nombre')."'";
			}else{
				$query_dura = "UPDATE mdl_user
				SET 
				firstname = '". $data['nombre'] ."', 
				lastname = '". $data['apellido'] ."', 
				email = '". $data['email'] ."',
				country = '". $data['pais'] ."',
				city = '". $data['ciudad'] ."'
				WHERE username = '". $this->session->userdata('nombre')."'";
			}
		}
		$result = $db_krismare->query($query_dura);
		return $result;
	}
}