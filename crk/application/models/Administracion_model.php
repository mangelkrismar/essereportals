<?php

class Administracion_model extends CI_Model
{
    function consultaTotalApps($data)
    {
		$filtroPalabras = "";
		$filtrosCategoria = "";
		//echo "recibiendo en el model" . $data['filtros']['palabras']."y la comparacion es:".isset($data['filtros']['palabras']);
		if(isset($data['filtros']['palabras'])){//existen las palabras
			$filtroPalabras = "AND (
                nombre like '%".$data['filtros']["palabras"]."%'
                OR palabras_clave like '%".$data['filtros']["palabras"]."%'
                OR prefijo like '%".$data['filtros']["palabras"]."%'
                )";
		}
		if(isset($data['filtros']['categoria'])){//existe categoria
		
			$filtrosCategoria = "AND categoria = '".$data['filtros']['categoria']."'";
		}
		
		
        $query = "SELECT id_aplicacion,nombre, prefijo, 
		SUBSTRING(REPLACE(app.objetivos, '-', '</li><li>*'),6, LENGTH(REPLACE(app.objetivos, '-', '</li><li>*'))) AS objetivos,
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
			WHERE aprobada = 1 
			AND prefijo NOT LIKE '%red_rob%' 
            AND prefijo NOT LIKE '%red_pdc%' 
            AND prefijo NOT LIKE '%fls%' 
            AND prefijo NOT LIKE '%bra%'
            AND SUBSTRING(prefijo,9,1) < 7
			".$filtroPalabras."
			".$filtrosCategoria."
			ORDER BY SUBSTRING(prefijo, 4, 20)
            LIMIT ".$data["inicio"].", ".$data["fin"]."";
			
		$queryTotal = "SELECT id_aplicacion
			FROM aplicacion 
			WHERE aprobada = 1 
			AND prefijo NOT LIKE '%red_rob%' 
            AND prefijo NOT LIKE '%red_pdc%' 
            AND prefijo NOT LIKE '%fls%' 
            AND prefijo NOT LIKE '%bra%'
            AND SUBSTRING(prefijo,9,1) < 7
			".$filtroPalabras."
			".$filtrosCategoria."";
		
		
		$apps = $this->db->query($query);
		$total = $this->db->query($queryTotal);
		$res['apps'] = $apps->result();
		$res['total'] = $total->num_rows();
		
		return $res;
        
    }
	
	function consultaDemos($tipoDemo){
		$qportal = $this->config->item('qportal');
		
		$query = "SELECT app.nombre, app.prefijo, 
		CASE 
		WHEN app.categoria ='aplicacion'
			THEN 'app'
		WHEN app.categoria ='aplicacionL'
			THEN 'appL'
		ELSE
			app.categoria
		END
			AS categoria
			FROM aplicacion app, configuracion_app ca 
			WHERE app.prefijo = ca.prefijo 
			AND ca.tipo_demo = $tipoDemo 
			AND ca.portal = $qportal
			ORDER BY numero_orden";
			
		$result = $this->db->query($query);
		
		return $result->result();
		
	}
	
	function deleteDemoByPrefijo($prefijo, $tipoDemo){
		$qportal = $this->config->item('qportal');
		
		$query = "DELETE FROM configuracion_app
					WHERE prefijo = '$prefijo'
					AND tipo_demo = $tipoDemo
					AND portal = $qportal";
		
		$this->db->query($query);
		
	}
	
	function selectDemoByPrefijo($prefijo, $tipoDemo){
		$qportal = $this->config->item('qportal');
		
		$query = "SELECT prefijo 
					FROM configuracion_app
					WHERE prefijo = '$prefijo'
					AND tipo_demo = $tipoDemo
					AND portal = $qportal";
					
		$result = $this->db->query($query);
		
		if($result->num_rows() > 0){
			
           return $result->row();
		   
        }else{
			
            return null;
			
        }
		
	}
	
	function updateDemoByPrefijo($prefijo, $demo, $numero){
		$qportal = $this->config->item('qportal');
		
		$update = "UPDATE configuracion_app 
					SET numero_orden = $numero 
					WHERE prefijo = '$prefijo' 
					AND tipo_demo = $demo
					AND portal = $qportal";
		
		$this->db->query($update);
		
	}
	
	function insertDemoByPrefijo($prefijo, $demo, $numero){
		$qportal = $this->config->item('qportal');
		
		$insert = "INSERT INTO  configuracion_app (prefijo, numero_orden, tipo_demo, portal) 
		VALUES ('". $prefijo ."', ".$numero.",". $demo.", $qportal);";
		
		$this->db->query($insert);
		
		
	}
	
	function seleccionaHojaUsuarios($inicio, $fin, $order){
	
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "SELECT mu.firstname, mu.lastname, mu.email, mu.city, mu.country, up.lastaccess 
		FROM mdl_user mu, primaria_ultimo_acceso up 
		WHERE mu.id = up.id_usuario 
		ORDER BY $order
		LIMIT $inicio, $fin";
		
		$queryTotal = "SELECT * FROM primaria_ultimo_acceso";
		
		$total = $db_krismare->query($queryTotal);
		
		$apps = $db_krismare->query($query);
		
		$result['total'] = $total->num_rows();
		
		$result['apps'] = $apps->result();
		
		return $result;
	}
	
	function obtenerUsuariosActivos(){
		
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
		
			SELECT mu.id, mu.username FROM mdl_user mu, primaria_ultimo_acceso pua WHERE pua.id_usuario = mu.id
			
		";
		
		$result = $db_krismare->query($query);
		
		return $result;
		
	}
	
	function allRecordsLog($data){
		//print_r($data);
		$condicionFecha = "";
		$condicionAcciones = "";
		$condicionParticipantes = "";
		if($data['fecha'] != "todos"){
			
			$condicionFecha = " AND FROM_UNIXTIME(time, '%Y-%m-%d') = '".$data['fecha']."'";
			
		}
		if($data['acciones'] != "Todas"){
			
			$condicionAcciones = " AND action LIKE '%". $data['acciones'] ."%'";
			
		}/*else if($data['acciones'] == "Cambios"){
			
			//$condicionAcciones = " AND action NOT LIKE '%view%'";
			
		}*/
		
		if($data['usuarios'] != "Todos"){
			
			$condicionParticipantes = " AND mu.username = '". $data['usuarios']."'";
			
		}
		
		
		$db_krismare = $this->load->database("krismare", TRUE);
		
		$query = "SELECT pl.time, pl.ip, mu.firstname, mu.lastname, pl.action, pl.info, pl.dispositivo		
		FROM primaria_log pl, mdl_user mu 
		WHERE mu.id = pl.userid 
		".$condicionFecha."
		".$condicionAcciones."
		".$condicionParticipantes."
		ORDER BY pl.time DESC
		LIMIT " .$data['inicio']." , ". $data['fin']."";
	
		$queryTotal = "SELECT pl.time, pl.ip, mu.firstname, mu.lastname, pl.action, pl.info, pl.dispositivo
		FROM primaria_log pl, mdl_user mu 
		WHERE mu.id = pl.userid 
		".$condicionFecha."
		".$condicionAcciones."
		".$condicionParticipantes."";
		
		$total = $db_krismare->query($queryTotal);		
		
		$apps = $db_krismare->query($query);
		
		$result['total'] = $total->num_rows();
		
		$result['apps'] = $apps->result();
		
		return $result;
	
	}
	
	

}