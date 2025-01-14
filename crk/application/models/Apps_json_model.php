<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps_Json_model extends CI_Model {

	function get_curso($usuario = ''){
		
		$qportal = $this->config->item('qportal');
		$id_curso = $this->get_id_curso($qportal);

		// Si existe un curso con ese id
		if($id_curso){
			// La lista de grados que puede ver el usuario en el portal
			$str_grados = $this->get_str_grados($usuario);
			// Los nombres de los grados y materias que puede ver el usuario en el portal
			/*
			    Los nombres se envian por separado a las aplicaciones por cuestiones de 
			    tama�0�9o del JSON, dado que los nombres se repetirian muchas veces, es mas eficiente
			    solo hacer referencia por su id y recuperar su nombre cuando haga falta
			*/
			$nombres = $this->get_nombres($id_curso, $str_grados);
			return $curso = array(
				"aplicaciones" => $this->get_aplicaciones($id_curso, $str_grados),
				"grados"       => $nombres['grados'],
				"materias"     => $nombres['materias'],
				"temas"        => $nombres['temas']
			);
		} else{
			return array(
				"error" => "No existe un curso con id = $id_curso"
			);
		}
	}
	
	function get_id_curso($qportal){
		// Recuperamos el id del curso asociado al portal
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
			SELECT
			id_curso
			FROM portal
			WHERE qportal = $qportal
		;";

		$result = $db_krismare->query($query);
		$result_arr = $result->result_array();

		$id_curso = $result_arr[0]["id_curso"];

		// Comprobamos que exista un curso con ese id en Krismar Apps
        $db_ged2 = $this->load->database('dbged', TRUE);
		$db_krismar_apps = $this->load->database('default', TRUE);

		$query = "
			SELECT
			id
			FROM curso
			WHERE id = $id_curso
		;";

		$result = $db_ged2->query($query);
		$result_arr = $result->result_array();

		return $result_arr[0]["id"];

	}

	function get_usuario_grados($usuario){
		// Recupera información de la base de administración licencias
		// Primero recupera la lsita de grados (1,2,3,...)
		// Despues encuentra los id de los grados en Krismar Apps relacionados (12332,241562,312312,...)
		// Devuelve una string con una lista de esos id

		$db_krismare = $this->load->database('krismare', TRUE);
		$query = "
			SELECT portal_grados_json
			FROM mdl_user
			WHERE username = '$usuario'
		;";
		$result = $db_krismare->query($query);
		$arr_dummy = $result->result_array();
		$grados_usuario = json_decode($arr_dummy[0]['portal_grados_json']);
		$qportal = $this->config->item('qportal');
		
		if(property_exists($grados_usuario, $qportal)){
		    /* 
		        Si hay un registro del portal en el campo portal_grados_json,
		        busca que tenga el campo g, correspondiente a la lista de grados
		    */
			$grados_usuario_primaria = $grados_usuario->{$qportal}->{'g'};
			
			$comita = $str_grados_no = '';
			foreach ($grados_usuario_primaria as $grado) {
				$str_grados_no .= $comita .$grado;
				$comita = ', ';
			}

			$query = "
				SELECT grado_ka_id
				FROM portal_grados
				WHERE grado_no IN ($str_grados_no)
				AND qportal = $qportal
			;";
			$result = $db_krismare->query($query);
			$arr_dummy = $result->result_array();
			
			$comita = $str_grados = '';
			foreach ($arr_dummy as $grado) {
				$str_grados .= $comita .$grado['grado_ka_id'];
				$comita = ', ';
			}

			return $str_grados;
		} else{
			$str_grados =  '';
		}
		return $str_grados;
	}

	function get_str_grados($usuario){
		if($this->config->item('mostrar_apps_a_visitantes')||$this->config->item('permitir_todos_los_grados')){
			// Se deben devolver todos los grados en ese curso
			$str_grados = '';
		} else{
			// Se devuelven solo los grados que le pertenezcan al usuario
			$str_grados = $this->get_usuario_grados($usuario);
		}

		return $str_grados;
	}


	function get_aplicaciones($id_curso, $str_grados){
		$condicion_grados = '';
		if($str_grados != ''){
			$condicion_grados = "AND grado.id IN (".$str_grados.")";
		}

		/*
		    El siguiente query recupera datos de las aplicaciones, asi como los id de
		    su grado y materia correspondientes.
		    Se utiliza una sucesi��n de INNER JOIN para recuperar la totalidad del curso
		    en el orden que se especifica, por el nombre del grado, luego de la materia,
		    luego del bloque, por el id de la leccion y al final por el orden que se coloc��
		    dentro de la lecci��n a trav��s de la interfaz de MDT
		    
		    Es importante se�0�9alar que se cre�� una vista view0a_cursos_mdt que podr��a reemplazar
		    a este query, pero no me di tiempo de implementarlo, pero se implement�� en el modelo
		    Reporte_model.php
		*/
		$query = "
			SELECT
				materia.id_padre            AS g,
				bloque.id_padre           AS m,
				
				leccion_app.id_aplicacion    AS i,
				materia.id_padre			AS ogrado,
				bloque.id_padre			AS omateria,
				leccion.id_padre			AS obloque,
				leccion_app.id_leccion		AS oleccion,
				leccion_app.orden	AS orden

			FROM leccion_app
				INNER JOIN leccion   ON leccion.id      = leccion_app.id_leccion
				INNER JOIN bloque    ON bloque.id       = leccion.id_padre
				INNER JOIN materia   ON materia.id      = bloque.id_padre
				INNER JOIN grado     ON grado.id        = materia.id_padre
			
			WHERE grado.id_padre = $id_curso
			and materia.label not like 'habilidades%'
			".$condicion_grados."
			ORDER BY
				grado.orden,
				materia.orden,
				bloque.orden,
                leccion.orden,
				leccion_app.orden
		;";
        $db_ged2 = $this->load->database('dbged', TRUE);
		$result = $db_ged2->query($query);
		$result_arr = $result->result_array();
        $appslist = array_column($result_arr, 'i');

        $query = "select
        aplicacion.id_aplicacion    AS i,
        aplicacion.prefijo          AS p,
        aplicacion.nombre           AS n,
        aplicacion.categoria        AS c,
        aplicacion.palabras_clave   AS pc,
        aplicacion.objetivos 		AS o
        from aplicacion where id_aplicacion in (".join(",",array_unique($appslist)).")";

        $result = $this->db->query($query);
		$result_arr_apps = $result->result_array();
        $indexedArray = array();
        foreach($result_arr_apps as $app){
            $indexedArray[$app["i"]] = $app;
        }
        foreach($result_arr as &$resul){
            $resul = array_merge($resul, $indexedArray[$resul["i"]]);
        }
		return $result_arr;
	}

	function get_nombres($id_curso, $str_grados){
        $db_ged2 = $this->load->database('dbged', TRUE);
		$condicion_grados = '';
		if($str_grados != ''){
			$condicion_grados = "AND grado.id IN (".$str_grados.")";
		}

		$query = "
			SELECT
				materia.id_padre   AS g,
				materia.id AS i,
				materia.label     AS n
			
			FROM materia
				INNER JOIN grado ON grado.id = materia.id_padre

			WHERE grado.id_padre = $id_curso
			and materia.label not like 'habilidades%'
			".$condicion_grados."
			ORDER BY materia.label
		;";
		$result = $db_ged2->query($query);
		$materias = $result->result_array();

		$query = "
			SELECT
				grado.id AS i,
				grado.label   AS n
			
			FROM grado

			WHERE grado.id_padre = $id_curso
			".$condicion_grados."
			ORDER BY grado.label
		;";
		$result = $db_ged2->query($query);
		$grados = $result->result_array();

		$query = "
			SELECT
				bloque.id_padre           AS m,
				leccion_app.id_aplicacion   AS i
			FROM leccion_app
				INNER JOIN leccion   ON leccion.id      = leccion_app.id_leccion
				INNER JOIN bloque    ON bloque.id        = leccion.id_padre
				INNER JOIN materia   ON materia.id      = bloque.id_padre
				INNER JOIN grado     ON grado.id          = materia.id_padre
			
			WHERE grado.id_padre = $id_curso
			".$condicion_grados."
		;";
		$result = $db_ged2->query($query);
		$temasaux = $result->result_array();
        $temaux = array_column($temasaux,'i');
        $query = "
			SELECT
                id_aplicacion as i,
				palabras_clave
			FROM aplicacion
			WHERE id_aplicacion in (".join(",",array_unique($temaux)).");";
        $result = $this->db->query($query);
        $result_arr_apps = $result->result_array();
        $indexedArray = array();
        foreach($result_arr_apps as $app){
            $indexedArray[$app["i"]] = $app["palabras_clave"];
        }
        foreach($temasaux as &$resul){
            $resul["p"] = $indexedArray[$resul["i"]];
        }

		$result_arr = array(
			"grados"    => $grados,
			"materias"  => $materias,
			"temas"     => $temasaux
		);

		return $result_arr;
	}

	function get_app_objetivos($id_aplicacion){
	    /*
	        Devuelve los objetivos de una aplicacion buscandola por su id
	    */
		$query = "
			SELECT objetivos
			FROM aplicacion
			WHERE id_aplicacion = $id_aplicacion
		;";

		$result = $this->db->query($query);
		$result_arr = $result->result_array();
		return $result_arr;
	}
}