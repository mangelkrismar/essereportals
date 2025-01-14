<?php
	session_start();
	include ("conexionPandilla.php");
	
	
	function dias_transcurridos($fecha_i,$fecha_f){
		$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
		$dias 	= abs($dias); $dias = floor($dias);		
		return $dias;
	}

	$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
		 
	if ($conexion->connect_error) {
		die("La conexion falló: " . $conexion->connect_error);
	}

	$username = $_POST['username'];
	$password = $_POST['password'];
		  
	$sql = "SELECT * FROM $tbl_name WHERE usuario = '$username'";
	$result = $conexion->query($sql);

	//Aqui va la validadcion de las licencias
	if ($result->num_rows > 0) {    //El usuario exist
	
		$row = $result->fetch_array(MYSQLI_ASSOC);     //Para poder consulta los resultados de la base de datos
		
		$aMeses = array("ene","feb","mar","abr","may","jun","jul","ago","sep","oct","nov","dic");  //Para los meses del dia y asi dar acceso a los usuarios
		$mesA = $aMeses[date("n")-1];  //Para el mes actual
		$aux = str_split($username);   //Se trasforma el usuario en un vector
		$v_bol = false;   //para saber si el nombre inicia con V y este no es un codigo con vigencia
		$a_vocales = array("a","e","i","o","u");
				
		$fini = $row['fIni'];  //Se Obtiene la fecha de inicio del usuario
		$timeUser = $row['tDura'];    //Se obtiene el tiempo de vigencia de la licencia si es que trae, en dado caso sera 0
		
		$ingreso = date("Y-n-j");  //Obtenemos la fecha
		$tiempo = "";  //Para el tiempo de duracion
		
		$case1 = $aux[0];   //Para el case de duracion de usuario
		
		//Se verifica si al final del nombre trae vd, para los demos
		$leng = count($aux);  //Obenemos la cantidad total de elementos del arreglo
		$case2 = $aux[$leng-2].$aux[$leng-1];
		
		$entra = false;  //Para saber si entra o no el usuario
		
			
		if (md5($password)==$row['password']) {   //Verificamos si la clave es la misma			
			
			if($fini == 0){//ES la primera vez que ingresa; Guardemos la fecha				
				
				//Verificamos si ya trae dias definidos el usuario
				if($timeUser > 0){
					$qry = "UPDATE $tbl_name SET fIni='".$ingreso."', fUltimoa='".$ingreso."' WHERE usuario = '$username'";
				}else{
					//Se verifica si no es demo
					if(($case1 == "d") || ($case2 == "vd")){
						$tiempo = 20;  //para cualquier otro usuario de prueba se le da 20 dias
						//echo '<br> entro aqui : ';
						if(($case1 == "d")){
							//Se verifica si despues de la letra hay una vocal
							$v_bol = in_array($aux[1], $a_vocales);  //verificamos si despues de la v hay una vocal	
							//cho '<br> demo : '.$v_bol;
							if($v_bol){
								$tiempo = 365;  //un año
							}	
						}					
					}else{
						$tiempo = 365;  //para cualquier otro usuario 365						
					}						
					
					//La consulta que se  va a ejecutar
					$qry = "UPDATE $tbl_name SET fIni='".$ingreso."', fUltimoa='".$ingreso."', tDura='".$tiempo."' WHERE usuario = '$username'";
					
					//La validacion por mes
					$vbol = false;  //para saber si el usuario trae como nombre meses
				
					//Para la vigencia de los meses
					$mesU = $aux[0].$aux[1].$aux[2];   //para el mes del usuario
					$mesU = strtolower($mesU);  //Se convierte a minusculas todas las letras
					
					//Para saber si el usuario se valida por mes
					switch($mesU){
						case "ene":
						case "feb":
						case "mar":
						case "abr":
						case "may":
						case "jun":
						case "jul":
						case "ago":
						case "sep":
						case "oct":
						case "nov":
						case "dic":
							$vbol = true;
							break;
					}
					
					if($vbol){//EL usuario trae mes como nombre
						//echo "El mes del usuario es : ".$qMes; //strcasecmp($var1, $var2) == 0
						if (strcasecmp($mesA, $mesU) != 0) {
							//echo '<br>Otro mes..';
							/*****************/
							$_SESSION['loggedin'] = false;
							unset ($SESSION['username']);
							session_destroy();
							$entra = true;							
							/*************/
						}else{
							$qry = "UPDATE $tbl_name SET fIni=0, fUltimoa=0, tDura=0 WHERE usuario = '$username'";
						}
					}										
				}
				
				//Para saber si accede o no al sistema
				if($entra){
					header('Location: ../index.php?vencida');
				}else{		
					$conexion->query($qry);
					
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['start'] = time();
					$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
					
					//echo '<br> Duracion de la lic  : '.$qry;
					header('Location: ../pandilla.php');
				}				
			}else{//Ya ingreso			
				$hoy = date("Y-n-j");        //Obtenemos la fecha 
				$dura = $row['tDura'];    //La duracion del la licencia
				
				$interval = date_diff(date_create($fini), date_create($hoy));				
				$diasp = $interval->format('%a');
				
				/*
				echo '<br> pasaron : '.$diasp.'<br>';
				echo 'La diferencia : '.($dura - $diasp);*/
				
				//VERIFICAMOS EL TIEMPO DE DURACION DE LA LICENCIA
				if($dura != 0){  //Si tiene un tiempo de vigencia	
					if($dura >= $diasp){  //para saber cuantos dias nos qdan
						$qry = "UPDATE $tbl_name SET fUltimoa='".$ingreso."' WHERE usuario = '$username'";
					}else{
						$entra = true;
					}
				}else{  //Su licencia es infinita
					$qry = "UPDATE $tbl_name SET fUltimoa='".$ingreso."' WHERE usuario = '$username'";					
				}				
				
				//Para saber si accede o no al sistema
				if($entra){
					$_SESSION['loggedin'] = false;
					unset ($SESSION['username']);
					session_destroy();		
					
					header('Location: ../index.php?vencida');
				}else{		
					$conexion->query($qry);
					
					$_SESSION['loggedin'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['start'] = time();
					$_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
					
					//echo '<br> Duracion de la lic  : '.$qry;
					header('Location: ../pandilla.php');
				}				
			}
			
		}else{
			header('Location: ../index.php?error');
		}		
	}else{
		header('Location: ../index.php?error');
	}
	
	
	// $row = $result->fetch_array(MYSQLI_ASSOC);

	// if (md5($password)==$row['password']) { 
		
	// if ($row['tipoLicencia']=="anual") {

		// if ($row['primerIngreso']=="si") {
			// $sql2 = "UPDATE $tbl_name SET primerIngreso='no', fechaIngreso='".date("Y-m-d")."' WHERE usuario = '$username'";
			// $result2 = $conexion->query($sql2);
			// $_SESSION['loggedin'] = true;
			// $_SESSION['username'] = $username;
			// $_SESSION['start'] = time();
			// $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
		 
			// header('Location: ../pandilla.php');
		// }else{
			// $fecha_actual=date("Y-m-d");
			// $fecha_ingreso=$row['fechaIngreso'];
			// $time = strtotime($fecha_ingreso);
			// $newformat = date('Y-m-d',$time);

			// $diasCumplidos = dias_transcurridos($fecha_ingreso,$fecha_actual);

			// if($diasCumplidos>365){
				// header('Location: ../index.php?finSuscripcion');
			// }else if($diasCumplidos>=350 && $diasCumplidos<365){
				// $email_from = "soporte@krismar.com.mx";//correo del formulario
				// $email_to = $username;//correo a donde se va enviar el correo
				// $email_subject = "Aviso desde portal La Pandilla";//asunto del correo

				// $email_message = "<html> 
		// <head>
		// <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
	// <meta name='viewport' content='width = device-width, maximum-scale = 1, user-scalable=no'>
			// <style>
			// @font-face {
				// font-family:FedraSansStd;
				// src: url('http://www.krismar.com.mx/font/FedraSansStd Normal.otf') format('opentype');
			// }
			// .d_correoFondo{
				// width:500px;
				// display: table;
				// background-color:#E9E9E9;
			// }
			// .d_correoContenedor{
				// width: 96%;
				// margin: auto;
				// position: relative;
			// }
			// .d_correoEsp{
				// width: 100%;
				// height: 10px;
				// float: left;
			// }
			// .d_correoTXTGral{
				// width: 100%;
				// float: left;
			// }
			// .d_correoTXT{
				// font-family: FedraSansStd;
				// font-size: 0.8em;
				// padding: 1%;
				// float: left
			// }
			// .d_titulo{
				// width: 100%;
				// text-align: center;
				// font-size: 0.9em;
				// color: #0069B0;
				// font-weight: bold;
			// }
			// .d_subtitulo{
				// width: 40%;
				// color: #0069B0;
				// font-weight: bold;
				// text-align: right
			// }
		// .d_texto{
			// width: 60%;
			// color: #303030;
		// }   
		// .d_correoTabla{
			// width: 100%;
			// height: 150px;
			// float: left;
		// }
		// .d_IMG_gral{
			// width: 20%;
			// height: 100%;
			// float: left;
		// }
		// .d_IMG{
			// width: 90%;
			// height: 90%;
			// position: relative;
			// margin: auto;
			// background: url('http://www.pandilla.mdt.mx/img/tituloSesion.png') no-repeat center;
			// background-size: contain;
		// }
		// .d_INFO{
			// width: 20%;
			// height: 100%;
			// float: left;
			// font-family: FedraSansStd;
			// font-size: 0.8em;
			// text-align: center;
			// color:#303030;
		// }
		// .d_sombra{
			// width: 500px;
			// height: 50px;
			// background: url('http://www.krismar.com.mx/img/sombra2.png') no-repeat;
			// background-size: contain;
			// float: left;
		// }
						// </style>
					// </head>
						// <body >
			// <div class='d_correoFondo'>
				// <div class='d_correoContenedor'>
							// <div class='d_correoTXTGral'>
						// <div class='d_correoEsp'></div>
						// <table class='d_correoTXT d_titulo'><tr><td>¡AVISO DE LICENCIA!</td></tr></table>
						// <table class='d_correoTXT d_titulo'><tr><td>“Hola, te comentamos que tu licencia esta próxima a caducar, está al pendiente para renovar tu licencia”</td></tr></table>
						// <table class='d_correoTXT d_titulo'><tr><td>Tus datos de acceso son:</td></tr></table>
						// <table class='d_correoTXT d_subtitulo'><tr><td>Usuario:</td></tr></table>
						// <table class='d_correoTXT d_texto'><tr><td>".$_REQUEST['correoE']."</td></tr></table>            
						// <div class='d_correoEsp'></div>
						// <table class='d_correoTXT d_subtitulo'><tr><td>Link de acceso:</td></tr></table>
						// <table class='d_correoTXT d_texto'><tr><td><a href='http://www.pandilla.mdt.mx'>http://www.pandilla.mdt.mx</a></td></tr></table>
					// </div>
				// </div>
			// </div>
			// <div class='d_sombra'></div>
						// </body>
					// </html>";//mensaje en formato html del correo

			// $headers = "MIME-Version: 1.0\r\n"; //header del correo
			// $headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos
			// $headers .= "From:".$email_from."\r\n"; //de donde viene el correo
			// @mail($email_to,$email_subject,$email_message,$headers);//envia el correo
				// $_SESSION['loggedin'] = true;
				// $_SESSION['username'] = $username;
				// $_SESSION['start'] = time();
				// $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
		 
				// header('Location: ../pandilla.php');
			// }else{
				// $_SESSION['loggedin'] = true;
				// $_SESSION['username'] = $username;
				// $_SESSION['start'] = time();
				// $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
		 
				// header('Location: ../pandilla.php');
			// }

		// }
	// }else{
		// $_SESSION['loggedin'] = true;
		// $_SESSION['username'] = $username;
		// $_SESSION['start'] = time();
		// $_SESSION['expire'] = $_SESSION['start'] + (30 * 60);
		 
		// header('Location: ../pandilla.php');
	// }

	// } else { 
		// header('Location: ../index.php?error');
	// }
	//mysqli_close($conexion);

?>