<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model
{
	function get_user($usuario = ''){
		if($this->config->item('migrar_usuarios_viejos_a_adminlic')){
			return $this->migrar_usuario($usuario);
		} else{
			$user_al = $this->get_user_al($usuario);
			if($user_al){
				if($this->validar_acceso($user_al->portal_grados_json)){
					$user_al = $this->validar_fIni($user_al);
					$user_al_arr = (array)$user_al;
					$user_al_arr['password'] = $this->get_portal_password($user_al->portal_grados_json);
					$user_al = (object)$user_al_arr;
				}
				return $user_al;
			} else{
				return null;
			}
		}
	}

	function updateUsername($id, $newUsuario){
		$db_krismare = $this->load->database('krismare', TRUE);
		$query = "UPDATE mdl_user SET username='".$newUsuario."' WHERE id = '".$id."';";
		$result = $db_krismare->query($query);
	}

	function guardaSesion($portalID, $sessionID, $userID){
		/*
		* NOMBRE: guardaSesion
		* UTILIDAD: Guarda una entrada en la tabla de sesiones con el usuario, portal e id de sesion especificados.
			* En caso de que exista un registro de ese usuario, solo actualiza el campo de session por portal
			* Agrega portal:IdSesion en caso de que no exista o lo sobre escribe si ya existe
		* ENTRADAS: portalID > numero: el id del portal del que se acceso, sessionID > alfanumerico: el id de la sesion activa el usuario, userID > numero: el id del usuario.
		* SALIDAS: booleano TRUE si tuvo exito, FALSE si falló.
		* VARIABLES: Ninguna.
		*/
		$db_krismare = $this->load->database('krismare', TRUE);
		$query = "SELECT session_id FROM sessions WHERE user_id = '".$userID."';";
		$result = $db_krismare->query($query);
		if ($result->num_rows()>0) {
			$aux = $result->row_array()['session_id'];
			$aux = json_decode($aux, true);
			$aux[$portalID] = $sessionID;
			$query = "UPDATE sessions SET session_id = '".json_encode($aux)."' WHERE user_id = '".$userID."';";
		}else {
			$arr = array($portalID => $sessionID);
			$query = "INSERT INTO sessions (user_id, session_id) VALUES ('".$userID."','".json_encode($arr)."');";
		}
		return $db_krismare->query($query);
	}

	function borraSesion($userID,$portalID){
		/*
		* NOMBRE: borraSesion
		* UTILIDAD: Elimina la relación Usuario>portal:IdSesion en caso de existir
			* Además, si esta relacion era la ultima para la entrada del usuario en la tabla de sessions, elimina el registro completo.
		* ENTRADAS: portalID > numero: el id del portal del que se acceso, userID > numero: el id del usuario.
		* SALIDAS: booleano TRUE si tuvo exito, FALSE si falló.
		* VARIABLES: Ninguna.
		*/
		$db_krismare = $this->load->database('krismare', TRUE);
		$query = "SELECT session_id FROM sessions WHERE user_id = '".$userID."';";
		$result = $db_krismare->query($query);
		if ($result->num_rows()>0) {
			$aux = $result->row_array()['session_id'];
			$aux = json_decode($aux, true);
			unset($aux[$portalID]);
			if (empty($aux)) {
				$query = "DELETE FROM sessions WHERE user_id = '".$userID."';";
			} else {
				$query = "UPDATE sessions SET session_id = '".json_encode($aux)."' WHERE user_id = '".$userID."';";
			}
			return $db_krismare->query($query);
		}
		return true;
	}

	function sesionValida($portalID, $sessionID, $userID){
		/*
		* NOMBRE: sesionValida
		* UTILIDAD: Verifica que exista una relacion Usuario>portal:IdSesion en la tabla sessions
		* ENTRADAS: portalID > numero: el id del portal del que se acceso, sessionID > alfanumerico: el id de la sesion activa el usuario, userID > numero: el id del usuario.
		* SALIDAS: booleano TRUE si existe una relacion tal como se esperaba, FALSE si no existe la relacion exacta.
		* VARIABLES: Ninguna.
		*/
		//error_log("se recibio para validar ".$portalID." : ".$sessionID." : ".$userID, 0);
		$db_krismare = $this->load->database('krismare', TRUE);
		$query = "SELECT session_id FROM sessions WHERE user_id = '".$userID."';";
		$result = $db_krismare->query($query);
		if ($result->num_rows()>0) {
			//error_log("Existe el registro ".$result->row_array()['session_id'], 0);
			$aux = $result->row_array()['session_id'];
			$aux = json_decode($aux, true);
			if (isset($aux[$portalID])) {
				//error_log("Existe la sesion esperada de portal esperada ", 0);
				return strcmp($aux[$portalID], $sessionID) == 0;
			}/*else{
				error_log("No existe la sesion esperada", 0);
			}*/
		}
		//error_log("No existe tal registro en base", 0);
		return false;
	}

	function migrar_usuario($usuario = ''){
		/*
		*	AL: AdminLicencias, se utiliza tambien para referirse a los datos provenientes de esa base
		*	BP: Se refiere a la Base de datos del Portal
		*	PGJ: El campo portal_grados_json
		*
		*/
		// Busca al usuario en la base de AdminLicencias
		$user_al = $this->get_user_al($usuario);
		
		// Hay un usuario en AL con ese nombre
		if($user_al != null){
			// El usuario tiene acceso al portal
			if($this->validar_acceso($user_al->portal_grados_json)){
				/* Comprobar que la fecha de inicio de la licencia esté declarada,
				   Si no lo está entonces le asigna el día de hoy como fecha de inicio y
				   365 dias de vigencia (td = 365) o lo deja como usuario
				   de licencia permanente si (td = 0)
				*/
				$user_al = $this->validar_fIni($user_al);

				/*
				Recupera la contraseña del portal, la comparacion de la contraseña en el PGJ
				y la que ingresó el usuario se realiza a nivel de controlador
				*/
				$user_al_arr = (array)$user_al;
				$user_al_arr['password'] = $this->get_portal_password($user_al->portal_grados_json);
				$user_al = (object)$user_al_arr;

				return $user_al;
			} else{
			    // El usuario no tiene acceso al portal
			    /*
			        Hay de dos:
			        1. Que el usuario tenga una cuenta en la base viejita y
			            hay que importar sus datos a AL
			        2. Que el usuario no tenga cuenta en la base viejita, por lo tanto
			            no tiene acceso al portal
			    */
				$user_bp = $this->get_user_bp($usuario);
				if($user_bp){
					$user_bp_arr = (array)$user_bp;
					$user_bp_arr['portal_grados_json'] = $this->generar_pgj($user_bp);
					$user_bp = (object)$user_bp_arr;

					// Se comprueba si la licencia está vigente o es permanente
					$licencia_valida = $this->validar_licencia($user_bp->portal_grados_json);
					
					if($licencia_valida){
						// Se arma un pgj con los datos del usuario y los datos recuperados de AL
						$pgj_nuevo = $this->combinar_pgjs($user_bp->portal_grados_json, $user_al->portal_grados_json);
						
						// Se actualizan los datos del usuario en AL
						$user_al->portal_grados_json = $pgj_nuevo;
						$this->update_user_al_pgj($user_al);

						// Se vuelve a llamar a la función, bajo el supuesto de que ahora el usuario está en AL y tiene acceso
						return $this->get_user($usuario);
					} else{
						return $user_bp;
					}
				} else{
					$user_al_arr = (array)$user_al;
					$user_al_arr['password'] = $this->get_portal_password($user_al->portal_grados_json);
					$user_al = (object)$user_al_arr;

					return $user_al;
				}
			}
		} else{
			// El usuario no esta en AL
			// Busca al usuario en la base del portal
			$user_bp = $this->get_user_bp($usuario);
			if($user_bp){
				// El usuario está en la base del portal
				// Se genera su portal_grados_json y se agrega al renglón recuperado de la BP
				$user_bp_arr = (array)$user_bp;
				$user_bp_arr['portal_grados_json'] = $this->generar_pgj($user_bp);
				$user_bp = (object)$user_bp_arr;

				// Si la licencia es válida se guarda el nuevo registro en AdminLic
				$licencia_valida = $this->validar_licencia($user_bp->portal_grados_json);
				if($licencia_valida){
					$this->insert_user_al($user_bp);

					// Se recupera el nuevo registro desde AdminLic
					$user_al = $this->get_user_al($usuario);

					$user_al_arr = (array)$user_al;
					$user_al_arr['password'] = $this->get_portal_password($user_al->portal_grados_json);
					$user_al = (object)$user_al_arr;

					// Se devuelve dicho usuario al controller
					return $user_al;
				} else{
					return $user_bp;
				}
			} else{
				// El usuario no está en la BP ni en AL
				return null;
			}
		}
	}

	function validar_fIni($user_al){
		/*
		    Verifica si la licencia del usuario ya tiene una fecha de inicio
		    y que tiempo de duración tiene.
		    
		    Si el usuario tiene una fecha de inicio válida y un tiempo de duración 0, entonces
		    es un usuario con licencia permanente
		    
		    Si solo no tiene una fecha, se le asignan 365 días
		    
		    Si es un usuario TOMI, se le asignan 730 dias (2 años)
		*/
		$qportal = $this->config->item('qportal');
		$pgj_arr = json_decode($user_al->portal_grados_json);
		
		$pTomi = $this->config->item('prefijo_tomi');

		if(property_exists($pgj_arr, $qportal)){
			$fi = $pgj_arr->{$qportal}->{'fi'};
			$td = $pgj_arr->{$qportal}->{'td'};
			$user_al->auxFI = $fi;
			if((!$fi || $fi == 'false' || $fi == '0' || $fi == false)){
				$pgj_arr->{$qportal}->{'fi'} = date("Y-m-d");
				if($td == 0){
					$pgj_arr->{$qportal}->{'td'} = 365;
					// Si existe el prefijo para usuarios TOMI
					if($pTomi != ''){
            			if(substr($user_al->username, 0, strlen($pTomi)) === $pTomi){
            				$pgj_arr->{$qportal}->{'td'} = 730;
            			}
            		}
				}

				$user_al->portal_grados_json = json_encode($pgj_arr);
				$this->update_user_al_pgj($user_al);
			}
		}

		return $user_al;
	}

	function update_user_al_pgj($user_al){
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
			UPDATE mdl_user
			SET portal_grados_json = '".$user_al->portal_grados_json."' 
			WHERE username = '".$user_al->username."'
		;";

		$result = $db_krismare->query($query);

		return $result;
	}

	function insert_user_al($user_bp){
		$db_krismare = $this->load->database('krismare', TRUE);

		$query = "
			INSERT INTO mdl_user(
				username,
				firstname,
				lastname,
				email,
				city,
				country,
				portal_grados_json
			)
			VALUES(
				'".$user_bp->username."',
				'".$user_bp->firstname."',
				'".$user_bp->lastname."',
				'".$user_bp->email."',
				'".$user_bp->city."',
				'".$user_bp->country."',
				'".$user_bp->portal_grados_json."'
			)
		;";

		$result = $db_krismare->query($query);

		return $result;
	}

	function get_portal_password($portal_grados_json = ''){
		// Usando el id del portal, recupera la contraseña encriptada dentro del pgj
		$qportal = $this->config->item('qportal');
		$pgj_arr = json_decode($portal_grados_json);

		if(property_exists($pgj_arr, $qportal)){
			$pwd = $pgj_arr->{$qportal}->{'pwd'};
		} else{
			$pwd = null;
		}

		return $pwd;
	}

	function combinar_pgjs($pgj_bp, $pgj_al){
	    /*
	        Se tiene (A) y (B)
	        y hace lo siguiente:
	        (A
	        B)
	        (A,B)
	    */
		$pgj_bp[strlen($pgj_bp)-1] = ' ';
		$pgj_al[0] = ' ';
		$pgj_new = $pgj_bp .','. $pgj_al;

		return $pgj_new;
	}

	function generar_pgj($user){
		$qportal = $this->config->item('qportal');
		$fi      = $user->fIni;
		$td      = $user->tDura;
		$pwd     = $user->password;

		if(!$fi || $fi == 'false' || $fi == '0' || $fi == false){
			$fi = date("Y-m-d");
			if($td == 0){
				$td = 365;
			}
		}
		
		//Se modifico para que solo se permita el acceso a sexto grado en los demos de cada mes
		//$pgj_bp = '{"QPORTAL":{"g":["6"],"fi":"FINI","td":"TDURA","pwd":"PASSWORD"}}';
		$pgj_bp = '{"QPORTAL":{"g":["1","2","3","4","5","6"],"fi":"FINI","td":"TDURA","pwd":"PASSWORD"}}';
		
		

		$pgj_bp = str_replace("QPORTAL" ,$qportal,$pgj_bp);
		$pgj_bp = str_replace("FINI"    ,$fi     ,$pgj_bp);
		$pgj_bp = str_replace("TDURA"   ,$td     ,$pgj_bp);
		$pgj_bp = str_replace("PASSWORD",$pwd    ,$pgj_bp);

		return $pgj_bp;
	}

	function validar_licencia($portal_grados_json = ''){
		// Comprueba que la licencia aún es vigentes
		$qportal = $this->config->item('qportal');
		$pgj_arr = json_decode($portal_grados_json);

		$tDura = $pgj_arr->{$qportal}->{'td'};
		$fIni = $pgj_arr->{$qportal}->{'fi'};

		$start_date = strtotime($fIni); 
		$end_date = strtotime(date("Y-m-d"));
		$diasR = $tDura - floor(($end_date - $start_date)/60/60/24);

		if($tDura == 0 && $fIni){
			// Licencia permanente
			return true;
		} else if($diasR < 0){
			return false;
		} else if($tDura < $diasR){
			return false;
		} else{
			return true;
		}
	}

	function validar_acceso($portal_grados_json = ''){
		// Verifica si el usuario tiene acceso al portal identificandolo con un id en el pgj
		$qportal = $this->config->item('qportal');
		$grados_usuario = json_decode($portal_grados_json);

		if(property_exists($grados_usuario, $qportal)){
			// El usuario cuenta con acceso al contenido del portal
			return true;
		} else{
			// El usuario no cuenta con acceso al contenido del portal
			return false;
		}
	}

	function get_user_al($usuario = ''){
		$db_krismare = $this->load->database('krismare', TRUE);

		$consulta = "
			SELECT *
			FROM mdl_user
			WHERE username = '" . $usuario . "'";
		$result = $db_krismare->query($consulta);
		
		if($result->num_rows() > 0){
			return $result->row();
		} else{
			return null;
		}
	}

	function get_user_bp($usuario = ''){
		$db_krismare_old = $this->load->database('krismare_old', TRUE);

		$consulta = "
			SELECT *
			FROM mdl_user
			WHERE username = '" . $usuario . "'";
		$result = $db_krismare_old->query($consulta);
		
		if($result->num_rows() > 0){
			return $result->row();
		} else{
			return null;
		}
	}

	function actualizaVigencia($pgj, $username){
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
			UPDATE mdl_user
			SET portal_grados_json = '$pgj' 
			WHERE username = '$username'
		;";
			
		$db_krismare->query($query);
	}

	function actualizaPrimerAcceso($username){
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
			SELECT firstaccess
			FROM mdl_user
			WHERE username = '$username'
		;";
			
		$result = $db_krismare->query($query);
		$result_arr = $result->result_array();
		$fa = $result_arr[0]["firstaccess"];

		if($fa == 0){
			$query = "
				UPDATE mdl_user
				SET firstaccess = UNIX_TIMESTAMP(NOW())
				WHERE username = '$username'
			;";
				
			$db_krismare->query($query);
		}
	}	

	function actualizaUltimoAcceso($username){
		$this->actualizaPrimerAcceso($username);
		
		$db_krismare = $this->load->database('krismare', TRUE);
		
		$query = "
			UPDATE mdl_user
			SET lastaccess = UNIX_TIMESTAMP(NOW()) 
			WHERE username = '$username'
		;";
			
		$db_krismare->query($query);

		$query = "
			UPDATE mdl_user
			SET nAccesos = nAccesos + 1 
			WHERE username = '$username'
		;";
			
		$db_krismare->query($query);
	}
}