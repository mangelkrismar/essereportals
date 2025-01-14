<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tomi_model extends CI_Model {

	function validarCredenciales($username = '', $password = ''){
		
		/*
		    Esta funcion determina si el usuario que intenta activar un dispositivo
		    TOMI cumple las siguientes condiciones:
		    1.- El username cuenta con el prefijo TOMI especificado
		    2.- El username corresponde a un usuario que existe en la base de datos
		        mdt_adminsitracion_licencias en la tabla mdl_user
		    3.- Que dicho usuario tenga acceso al portal Primaria, esto se determina
		        leyendo el campo portal_grados_json
		    4.- Que la contrase«Ða encriptada correspondiente al portal Primaria sea
		        igual a la que ingres«Ñ el usuario (una vez que ha sido encriptada)
		    5.- Si la licencia del portal Primaria no ha sido activada previamente,
		        la activa con un periodo de 730 d«¿as (2 a«Ðos), esto le concede acceso a
		        la versi«Ñn online del portal Primaria
		    6.- Se comprueba si existe un campo llamado tomi, si no existe o tiene un valor
		        de false, se agrega o se cambia su valor a true segun corresponda,
		        esto indica que su TOMI ha sido activado exitosamente
		    7.- Si el campo tomi estaba en true, entonces se considera que ya se ha
		        activado un TOMI anteriormente, por lo que se devuelve false.
		    
		    
		    Cada uno de estos pasos devuelve true o false, junto con un mensaje de error
		    Dicho mensaje indica por que la activaci«Ñn fue o no exitosa
		*/
		$prefijo = $this->config->item('prefijo_tomi');
		
		$response = array(
			'unlock' => false
		);
		
		if($this->config->item('prefijo_tomi') != ''){
			if(substr($username, 0, strlen($prefijo)) !== $prefijo){
				$response['msg'] = "el usuario no tiene el prefijo tomi";
				return $response;
			}
		}
		
		$user_data = $this->get_user($username);
		if($user_data){
			$response['msg'] = "el usuario existe en mdl";
			
			if($this->validarAccesoPortal($user_data)){
				$response['msg'] = "tiene acceso a Primaria";
				
				if($this->validarPassword($user_data, $password)){
					
					$response['msg'] = "contraseÃ±a correcta";
					
					// Si se activÃ³ la licencia hay que
					// recargar el contenido del usuario
					$this->activarLicencia($user_data);
					$response['msg'] = "licencia activa";
					$user_data = $this->get_user($username);
					
					$activarTomi = $this->activarTomi($user_data);
					
					// recargar el contenido del usuario
					$user_data = $this->get_user($username);
					
					if($activarTomi){
						$response['unlock'] = true;
						$response['msg'] = "Tu TOMI esta siendo activado....";
					} else{
						$response['msg'] = "Lo sentimos, ya se ha activado un TOMI con esta cuenta";
					}

				} else{
					$response['msg'] = "contraseÃ±a incorrecta";
				}
			} else{
				$response['msg'] = "no tiene acceso a Primaria :C";
			}
		} else{
			$response['msg'] = "el usuario no existe en mdl";
		}
		
		return $response;
	}

	function desactivarTomi($username){
		/*
		    Comprueba si el usuario tiene un TOMI activado a su nombre
		    Si es asi, lo desactiva
		*/
		$response = array();
		$user_data = $this->get_user($username);
		
		$user_data = $this->get_user($username);
		if($user_data){
			$response['msg'] = "el usuario existe en mdl";
			
			if($this->validarAccesoPortal($user_data)){
				$response['msg'] = "tiene acceso a Primaria";
				
				$qportal = $this->config->item('qportal');
				$pgj = json_decode($user_data->portal_grados_json);

				// Si no existe el campo tomi en el pgj,
				// se agrega al pgj y se guarda
				if(!property_exists($pgj->{$qportal}, 'tomi')){
					$response['msg'] = "No ha activado un TOMI, no se desactiva";
				} else{
					$pgj->{$qportal}->{'tomi'} = false;
					$this->guardarPGJ(json_encode($pgj), $user_data->username);
					$response['msg'] = "El TOMI de ".$username." ha sido desactivado";
				}
				
			} else{
				$response['msg'] = "no tiene acceso a Primaria :C";
			}
		} else{
			$response['msg'] = "el usuario no existe en mdl";
		}

		return $response;
	}

	function activarTomi($user_data){
	    /*
	        Recibe todos los datos del usuario,
	        procesa el campo portal_grados_json y verifica si dentro del json existe el
	        campo tomi y que valor tiene
	        si el campo tomi est«¡ en true, entonces ya se ha activado un dispositivo TOMI con
	        este usuario, por lo que se devuelve false.
	        En otro caso, se cambia su valor a true, se guarda en la base de datos y se devuelve true
	    */
		$qportal = $this->config->item('qportal');
		$pgj = json_decode($user_data->portal_grados_json);

		// Si no existe el campo tomi en el pgj,
		// se agrega al pgj y se guarda
		if(!property_exists($pgj->{$qportal}, 'tomi')){
			$pgj->{$qportal}->{'tomi'} = true;
			$this->guardarPGJ(json_encode($pgj), $user_data->username);
			return true;
		} else{
			if($pgj->{$qportal}->{'tomi'} == false){
				$pgj->{$qportal}->{'tomi'} = true;
				$this->guardarPGJ(json_encode($pgj), $user_data->username);
				return true;
			} else{
				return false;
			}
		}
	}

	function guardarPGJ($portal_grados_json, $username){
	    /*
	        Recibe la string portal_grados_json y lo guarda en la tabla mdl_user
	        en el registro correspondiente al usuario
	    */
		$pgj = $portal_grados_json;
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
			UPDATE mdl_user
			SET portal_grados_json = '$pgj' 
			WHERE username = '$username'
		;";
			
		$db_krismare->query($query);
	}

	function activarLicencia($user_data){
	    /*
	        determina si la licencia del usuario ha sido activada previamente o no
	        si no ha sido activada le asigna dos a«Ðos de vigencia a partir de ese momento
	        esta licencia no determina si puede activar o no un dispositivo TOMI, solo si
	        puede iniciar sesi«Ñn en el portal Primaria.
	    */
		$qportal = $this->config->item('qportal');
		$pgj = json_decode($user_data->portal_grados_json);

		$fi = $pgj->{$qportal}->{'fi'};
		$td = $pgj->{$qportal}->{'td'};

		// Si la licencia no ha sido activada previamente
		if(!$fi || $fi == 'false' || $fi == '0' || $fi == false){
			$fi = date("Y-m-d");
			if($td == 0){
				$td = 730;// Dos aÃ±os
				
				$pgj->{$qportal}->{'fi'} = $fi;
				$pgj->{$qportal}->{'td'} = $td;

				$this->guardarPGJ(json_encode($pgj), $user_data->username);
			}
		}

		$licencia = array();
		$licencia['fi'] = $fi;
		$licencia['td'] = $td;

		return $licencia;
	}

	function validarPassword($user_data, $password){
	    /*
	        Ccomprueba si la contrase«Ða ingresada por el usuario corresponde a la que est«¡
	        almacenada en la base de datos
	    */
		$qportal = $this->config->item('qportal');
		$password_salt = $this->config->item('password_salt');
		
		$pgj = json_decode($user_data->portal_grados_json);
		$pwd = $pgj->{$qportal}->{'pwd'};
		
		if($pwd ==  md5($password.$password_salt)){
			return true;
		}
		return false;
	}

	function validarAccesoPortal($user_data){
	    /*
	        Comprueba si dentro del campo portal_grados_json existe el registro correspondiente
	        al portal Primaria
	    */
		$access = false;
		$qportal = $this->config->item('qportal');
		$grados_usuario = json_decode($user_data->portal_grados_json);

		if(property_exists($grados_usuario, $qportal)){
			$access = true;
		} else{
			$access = false;
		}

		return $access;
	}

	function get_user($usuario = ''){
	    /*
	        Devuelve los datos correspondientes al usuario en la tabla mdl_user en la base de datos
	        mdt_administracion_licencias
	    */
		$db_krismare = $this->load->database('krismare', TRUE);

		$consulta = "
			SELECT *
			FROM mdl_user
			WHERE username = '$usuario'
		;";
		$result = $db_krismare->query($consulta);
		
		if($result->num_rows() > 0){
			return $result->row();
		} else{
			return null;
		}
	}

    function getApps(){
        /*
            Devuelve todas las aplicaciones correspondientes al curso TOMI 2019
            Las recupera de una vista llamada view0a_cursos_mdt
        */
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
				mdt.palabras_clave AS pc,
				mdt.objetivos      AS o
			FROM view0a_cursos_mdt mdt
			WHERE curso = 'TOMI 2019'
		;";

		$result = $this->db->query($query);
		return $result->result_array();
	}
}

/* End of file Tomi_model.php */
/* Location: ./application/models/Tomi_model.php */