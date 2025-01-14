<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model
{
	function get_user($usuario = '')
	{
		$db_krismare = $this->load->database('krismare', TRUE);

		$consulta = "
			SELECT *
			FROM mdl_user
			WHERE username = '" . $usuario . "'";
		$result = $db_krismare->query($consulta);
		
		if($result->num_rows() > 0){//Hubo resultados
			return $result->row();
		}else{
			return null;
		}
	}
	
	function asignaFechaInicio($fIni, $id){
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query_ini = "
			UPDATE mdl_user 
			SET fIni = '$fIni'
			WHERE id = $id";
			
		$db_krismare->query($query_ini);
	}
	
	function asignaDuracion($tDura, $id){
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query_dura = "UPDATE mdl_user
			SET tDura = $tDura 
			WHERE id = $id";
			
		$db_krismare->query($query_dura);
	}
	
	function actualizaUltimoAcceso($IP, $dispositivo){
		/* Deshabilitada */
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$registro = "SELECT id 
		FROM primaria_ultimo_acceso
		WHERE id_usuario = ". $this->session->userdata('user_id');
		
		$resultRegistro = $db_krismare->query($registro)->num_rows();
		
		if($resultRegistro == 0){
			$insert = "INSERT INTO primaria_ultimo_acceso (id_usuario, lastaccess, ip, dispositivo)
						VALUES (". $this->session->userdata('user_id') .", ". time() .", '". $IP ."', '".$dispositivo."')";
			
			$db_krismare->query($insert);
			
		}else{
			$update = "UPDATE 
			primaria_ultimo_acceso 
			SET ip = '". $IP ."', lastaccess = ". time() .", dispositivo = '".$dispositivo."'
			WHERE id_usuario = ". $this->session->userdata('user_id');
			
			$db_krismare->query($update);
			
		}
		
	}
}