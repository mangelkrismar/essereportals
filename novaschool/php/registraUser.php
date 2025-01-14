<?php
header('Content-Type: text/html; charset=ISO-8859-1');  

	if(isset($_POST['nameUR'])){
		
		$plataforma = 0;
		$plataforma = (int) $_POST['qPlata'];
		
		include("conexBases.php");
		$conn=Conectarse($plataforma);   //Para conectarnos a la plataforma en cuestion
		
		include("conex_u.php");
		$conn1 = Conecta();
		
		mysql_set_charset('utf8');
		
		
		
		//Para obtener las variables q vienen desde ajax
		$name = $_POST["nameUR"];
		$clave = $_POST["claveUR"];
		$usuT = $_POST["usuT"];
		
		$email = $_POST["emailUR"];
		$quso = $_POST["qusoR"];
		$pais = $_POST["pais"];
		
		$mensa = "";
		$dato = -1;  //0: Usuario incorrecto; 1: Clave incorrecta; 
		
		/*********PARA LOS DATOS DEL USUARIO*************/
		
		$user = $name;    //El usuario
		$userName = $name;
		$userApellido = $name;		
		$correo = $email;
		$ciudad = 'Metepec';
		$pais2 = 'MX';
		$lang = 'es_mx_utf8';
		$fIni = date("Y-n-j");
		$tDura = '365';
		/******TERMINAN LOS DATOS DEL USUARIO************/
		
		
		//PARA VERIFICAR SI EL USUARIO YA EXISTE
		switch($plataforma){
			case 1:  //preescolar
				$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';
				$qryC = "SELECT * FROM mdl_user WHERE username = '".$name."'";
				$qryU = "UPDATE users SET user = '".$name."', clave = '".$clave."', correo = '".$email."', quso = '".$quso."', qpais = '".$pais."', qportal = '".$plataforma."', activa=1 WHERE userT = '".$usuT."'";  //Se actualiza				
				$claveM = md5($clave.$cvModle);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
				$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
				break;
			case 2:  //Secundaria
				$cvModle = '~jd1N%9d]H?yABV57h8*yKlP6]O';  //Secundaria				
				$qryC = "SELECT * FROM mdl_user WHERE username = '".$name."'";
				$qryU = "UPDATE users SET user = '".$name."', clave = '".$clave."', correo = '".$email."', quso = '".$quso."', qpais = '".$pais."', qportal = '".$plataforma."', activa=1 WHERE userT = '".$usuT."'";  //Se actualiza
				$claveM = md5($clave.$cvModle);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
				$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
				break;
				break;
			case 3:   //Ciencias, pandilla
				$qryC = "SELECT * FROM usuarios WHERE usuario = '".$name."'";
				$qryU = "UPDATE users SET user = '".$name."', clave = '".$clave."', correo = '".$email."', quso = '".$quso."', qpais = '".$pais."', qportal = '".$plataforma."', activa=1 WHERE userT = '".$usuT."'";  //Se actualiza
				$claveM = md5($clave);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO usuarios (usuario,password,nombre,apellidos,correo,primerIngreso,tipoLicencia)";
				$qryA = $qryA." VALUES ('".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','si','infinita')";
				break;
			case 4:			
			case 12:
			case 36:  //Primaria, Tecnologia niños y adultos
				$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';   //primaria
				$qryC = "SELECT * FROM mdl_user WHERE username = '".$name."'";
				$qryU = "UPDATE users SET user = '".$name."', clave = '".$clave."', correo = '".$email."', quso = '".$quso."', qpais = '".$pais."', qportal = '".$plataforma."', activa=1 WHERE userT = '".$usuT."'";  //Se actualiza
				$claveM = md5($clave.$cvModle);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
				$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
				break;
				break;
			case 5:  //Bachiller
				$cvModle = '';
				$qryC = "SELECT * FROM mdlbch_user WHERE username = '".$name."'";
				$qryU = "UPDATE users SET user = '".$name."', clave = '".$clave."', correo = '".$email."', quso = '".$quso."', qpais = '".$pais."', qportal = '".$plataforma."', activa=1 WHERE userT = '".$usuT."'";  //Se actualiza
				$claveM = md5($clave.$cvModle);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO mdlbch_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
				$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
				break;
				break;
			case 39:   //Evaluacion docente
				$qryC = "SELECT * FROM user WHERE usuario = '".$name."'";
				$qryU = "UPDATE users SET user = '".$name."', clave = '".$clave."', correo = '".$email."', quso = '".$quso."', qpais = '".$pais."', qportal = '".$plataforma."', activa=1 WHERE userT = '".$usuT."'";  //Se actualiza
				$claveM = md5($clave);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO user (usuario,password,nombre,apellido)";
				$qryA = $qryA." VALUES ('".$user."','".$claveM."','".$userName."','".$userApellido."')";
				break;
		}
		
		//SE REALIZA LA CONSULTA, PARA SABER SI EL USUARIO ELEGIDO A UN ESTA DISPONIBLE
		$result = mysql_query($qryC,$conn); 
		$row = mysql_num_rows($result);
		
		if($row == 0){
			//mysql_free_result($result);
			
			//Se actualiza la base en donde estan los usuarios
			mysql_query($qryU,$conn1); 
			
			/************/
			$qrys = "SELECT * FROM portal WHERE qportal = '".$plataforma."'";
			$results = mysql_query($qrys,$conn1); 
			
			$rows = mysql_fetch_array($results);   //Para obtener los datos
			$qPort = $rows['namep'];     //Para la clave del producto
			/*********/
			
			
			//mysql_close($conn); 
			
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS
			mysql_query($qryA,$conn);	
			
			
			/*Para enviar el correo de que ya esta activo el usuario*/
			/*++++++++++++++++++++++++++++++++++++++++++*/
			
			/******ENVIO DE MAIL VIA PHP************/
			$destinatario = $correo;   /*Aqui va el correo del usuario q compro*/
			$asunto = "Clave de acceso Novaschool, usuario activado";
			$cuerpo = '<html>
					<head>
					   <title>Clave de acceso Novaschool</title>
					   <style>
							body{
								text-align: center;
								position:absolute;
								top: 0;
								left: 0;
								margin-top:0;
								margin-left:0;
								font-family: Calibri;
								width: 100%;
								height: 100%;
							}
							h1,h3{
								color: #12619B;
							}
							a{
                               color: #12619B;
                            }
							p{
								color: #4d4d4d;
							}
							img{
								width: 100%;
							}
							div{
								width:54%;
								display:table;
								margin:auto;
								margin-top:10px;
								margin-bottom:10px;
								border: 1px solid #4d4d4d;
								box-sizing:border-box;
								padding: 10px;
							}
							b{
								display:table;
							}
							@media only screen and (max-width: 500px) {
								div{
									width:100%;
								}
							}
					   </style>
					</head>
					<body>
					<img src="http://www.novaschool.mx/php/img/correo_pleca.png"></img>
					<h3>LA NUEVA CARA DE LA EDUCACIÓN</h3>
					<h1>Bienvenido al portal de <u>'.$qPort.'</u> de Novaschool.</h1>
					<p>
					Tu licencia quedó activada por 365 días a partir de tu primer ingreso al portal y con la siguiente información:
					<br/>
					</p>
					<div>
					<b>Usuario: </b>'.$user.'<br/>
					<b>Contraseña: </b>'.$clave.'<br/>
					</div>
					Si deseas tener acceso a un segundo portal, contacta a tu distribuidor y activa tu nueva licencia con el mismo nombre de usuario.
					<br/><br/>
					<b>Si tienes cualquier duda o comentario, escríbenos a cualquiera de estos correos:
					</b><br/><br/>
					<b><a href="mailto:ventas@krismar.lat?Subject=Información de licencias" target="_top">ventas@krismar.lat</a>, <a href="mailto:soporte@krismar.com.mx?Subject=Información de licencias" target="_top">soporte@krismar.com.mx</a><br/>
					<br/>
					Atentamente<br/>
					<a href="http://www.novaschool.mx" >Krismar Educación</a><br/>
					Gracias por tu preferencia
					</body>
					</html>';

					//para el envío en formato HTML
					$headers = "MIME-Version: 1.0\r\n";
					$headers .= "Content-type: text/html; charset=utf-8\r\n";    //Para que podamos ver los acentos y ñ en nuestros correos

					//dirección del remitente
					$headers .= "From: ventas <ventas@krismar.com.mx>\r\n";

					//dirección de respuesta, si queremos que sea distinta que la del remitente
					$headers .= "Reply-To: ventas@krismar.com.mx\r\n";

					//ruta del mensaje desde origen a destino
					$headers .= "Return-path: ventas@krismar.com.mx\r\n";

					//direcciones que recibián copia
					$headers .= "Cc: soporte@krismar.com.mx\r\n";

					//direcciones que recibirán copia oculta
					//$headers .= "Bcc: pepe@pepe.com,juan@juan.com\r\n";

			mail($destinatario,$asunto,$cuerpo,$headers);   //Aqui se envia el correo

			
			/*++++++++++++++++++++++++++++++++++++++++++*/
			
			
			$dato = 0;
		}else{
			$dato = 1;
		}		
		echo $dato;    //Se envía la respuesta ha ajax	
	}else{
		echo "no puedes..**  **hi";
	}
?>
