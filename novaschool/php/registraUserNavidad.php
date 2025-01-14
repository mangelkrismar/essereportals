<?php
//Para que no envie el warning por el uso obsoleto del manejo de la base de datos
	error_reporting(0);
	
	//header('Content-Type: text/html; charset=ISO-8859-1');  
if(stristr($_SERVER['HTTP_REFERER'], 'https://www.novaschool.mx') === FALSE){
	echo 41;
}else{
	if(isset($_POST['nombreCovid']) && isset($_POST['emailCovid'])){
		include("newConex.php");		
		
		//1: REGISTRO DE USUARIOS
		//2: USUARIOS DE LA PLATAFORMA	ADMIN LIC				
									
		//Creamos la conexión con la función de conectar y le damos formato de datos utf8
		$dbc = conectaDB(1);
		
		//Parea que interprete acentos y ñ
		mysqli_set_charset($dbc, "utf8");
		
		//Obtenemos el correo para validar
		$email = $_POST["emailCovid"];
		
		$qry = "SELECT * FROM userNavMex WHERE correonav = '".$email."'";
		
		//Se ejecuta la consulta para los registros	
		$rs = $dbc->query($qry);
					
		//Saber cuantos registros trae
		$tr = $rs->num_rows;
		$dato = $tr;
		if($tr == 0){
			$dato = 0;
			
			//Base krismar.mx
			$name = $_POST["nombreCovid"];
			$qportal = $_POST["qportal"];
			$uso = $_POST["qusoCovid"];
			$pais = $_POST["paisCovid"];
			$colegio = $_POST["colegioCovid"];
			$telefono = $_POST["telCovid"];
			$correo = $email;
			
			//Se libera la memoria
			$rs->free();
			
			//Para los registros
			$qry = "SELECT * FROM userNavMex ORDER BY id DESC LIMIT 1";
			
			//Se ejecuta la consulta para los registros	
			$rs = $dbc->query($qry);
					
			//Saber cuantos registros trae
			$tr = $rs->num_rows;
						
			/****SE GENERA EL USUARIO***/
			//Es el primer registro
			if($tr == 0){
				$idusr = 1;
				
				$namenav = 'ksrmnav'.$idusr;				
			}else{
				$datox = $rs->fetch_assoc();
				
				$idusr = $datox['id'];   //el indice del usuario
				$idusr = $idusr+1;
				
				$namenav = 'ksrmnav'.$idusr;				
			}
			
			/*****GENERA LA CLAVE****/
			$cve1 = gClave();
			
			//Se libera la memoria
			$rs->free();
			
			//Parea que interprete acentos y ñ
			mysqli_set_charset($dbc, "utf8");
			
			$qryI = "INSERT INTO userNavMex (id,qportal,usernav,clavenav,nombre,correonav,usonav,paisnav,colegionav,telefononav)";
			$qryI = $qryI." VALUES ('".$idusr."','".$qportal."','".$namenav."','".$cve1."','".$name."','".$correo."','".$uso."','".$pais."','".$colegio."','".$telefono."')";
			
			//Se inserta en la base, para el registro
			$dbc->query($qryI);
			
			//Se libera la memoria
			$rs->free();
					
			//Se cierra la conexion de la BD
			$dbc = cierraDB($dbc);					
			
			/*********PARA LOS DATOS DEL USUARIO*************/			
			$user = $namenav;    //El usuario
			$userName = $name;
			$userApellido = $namenav;					
			$ciudad = 'Metepec';
			$pais2 = 'MX';
			$lang = 'es_mx_utf8';
			$fi = date("2020-12-14");			
			$tDura = 17;
			$cve2 = "";
			
			/******TERMINAN LOS DATOS DEL USUARIO************/
			
			//Para el query de insertar el usuario en el portal correspondiente
			switch($qportal){
				case 2:  //Secundaria
					$cvModle = '~jd1N%9d]H?yABV57h8*yKlP6]O';  //Secundaria	
					$claveM = md5($cve1.$cvModle);
					
					$pgj_bp = '{"QPORTAL":{"g":["1","2","3"],"fi":"FINI","td":"TDURA","pwd":"PASSWORD"}}';
					
					$pwd = $claveM;					
					break;
				case 3:  //Ciencias
					$claveM = md5($cve1);
					$pwd = $claveM;	
					break;
				case 4:  //Primaria				
				case 42:  //Habilidades
					$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';   //primaria
					$claveM = md5($cve1.$cvModle);
					
					$pgj_bp = '{"QPORTAL":{"g":["1","2","3","4","5","6"],"fi":"FINI","td":"TDURA","pwd":"PASSWORD"}}';
					
					$pwd = $claveM;					
					break;
				case 40:  //Lecturas
					$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';   
					$claveM = md5($cve1.$cvModle);
					
					$pgj_bp = '{"QPORTAL":{"g":["1","2","3","4","5","6","7","8","9"],"fi":"FINI","td":"TDURA","pwd":"PASSWORD"}}';
					
					$pwd = $claveM;	
					break;
				case 46:  //Preescoolar
					$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';			
					$claveM = md5($cve1.$cvModle);
					
					$pgj_bp = '{"QPORTAL":{"g":["1","2","3"],"fi":"FINI","td":"TDURA","pwd":"PASSWORD"}}';
					
					$pwd = $claveM;	
					break;
			}
			
			if($qportal != 3){
				//Para que se inserte el usuario en la plataforma
				//Creamos la conexión con la función de conectar y le damos formato de datos utf8
				$dbc = conectaDB(2);
										
				//Parea que interprete acentos y ñ
				mysqli_set_charset($dbc, "utf8");
				
				$pgj_bp = str_replace("QPORTAL" ,$qportal,$pgj_bp);
				$pgj_bp = str_replace("FINI"    ,$fi     ,$pgj_bp);
				$pgj_bp = str_replace("TDURA"   ,$tDura  ,$pgj_bp);
				$pgj_bp = str_replace("PASSWORD",$pwd    ,$pgj_bp);
								
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura,portal_grados_json)";
				$qryA = $qryA." VALUES (1,1,'".$user."','".$cve2."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fi."','".$tDura."','".$pgj_bp."')";
				//$qryUdate = "UPDATE mdl_user SET firstname='".$userName."',lastname='".$userApellido."',fIni='".$fi."',portal_grados_json='".$pgj_bp."' WHERE username='".$user;
			}else{
				//Para que se inserte el usuario en la plataforma
				//Creamos la conexión con la función de conectar y le damos formato de datos utf8
				$dbc = conectaDB(3);
				
				//query para dar de Alta en la plataforma
				$qryA = "INSERT INTO usuarios (usuario,password,nombre,apellidos,correo,primerIngreso,tipoLicencia,fIni,fUltimoa,tDura)";
				$qryA = $qryA." VALUES ('".$user."','".$pwd."','".$userName."','".$userApellido."','".$correo."','si','infinita','".$fi."',0,'".$tDura."')";
										                                                                                                                                                                                                                                                                         
				//Parea que interprete acentos y ñ
				mysqli_set_charset($dbc, "utf8");
				
			}
			
			
			
			//Se inserta en la base	
			$dbc->query($qryA);			
			//Se cierra la conexion de la BD
			$dbc = cierraDB($dbc);	
			
			//Para saber que portal es
			$portalE = cualportal($qportal);
			
			/******ENVIO DE MAIL VIA PHP************/
					/*Para enviar el correo de que ya esta activo el usuario*/
					/*++++++++++++++++++++++++++++++++++++++++++*/			
					/******ENVIO DE MAIL VIA PHP************/
					$destinatario = $correo;   /*Aqui va el correo del usuario q compro*/
					$asunto = "Clave de acceso $portalE, usuario activado";
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
									h1,h2,h3{
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
										//display:table;
									}
									@media only screen and (max-width: 500px) {
										div{
											width:100%;
										}
									}
							   </style>
							</head>
							<body>
							<img src="https://www.novaschool.mx/php/img/correo_pleca.png"></img>
							<h3>LA NUEVA CARA DE LA EDUCACIÓN</h3>
							<h2>Bienvenido al portal de <u>'.$portalE.'</u> de Novaschool.</h2>
							<p>
							<b>Tu licencia se activara el 14 de diciembre del 2020, con la siguiente información:</b>
							<br/>
							</p>
							<div>
							<b>Usuario: </b><br/>'.$user.'<br/><br/>
							<b>Contraseña: </b><br/>'.$cve1.'<br/>
							</div>					
							<br/>
							<b>Si tienes cualquier duda o comentario, escríbenos al siguiente correo:
							</b><br/>
							<b><a href="mailto:soporte@krismar.com.mx?Subject=Información de licencias" target="_top">soporte@krismar.com.mx</a><br/>
							<br/>
							Atentamente<br/>
							<a href="https://www.novaschool.mx" >Krismar Educación</a><br/>
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
			/******ENVIO DE MAIL VIA PHP************/
					
			//$dato = $qportal;   //Se inserta
			
		}else{
			$dato = 1;
		}	
		
		echo $dato;		
	}
}
	
	//Para saber el portal al que el usuario se dio de alta
	function cualportal($portal){
		switch($portal){
			case 2:  //Secundaria
				$cual = 'Secundaria';					
				break;
			case 3:  //Ciencias
				$cual = 'Ciencias para niños';
				break;
			case 4:  //Primaria	
				$cual = 'Primaria';
				break;
			case 42:  //Habilidades
				$cual = 'Habilidades';				
				break;
			case 40:  //Lecturas
				$cual = 'Lecturas';
				break;
			case 46:  //Preescoolar
				$cual = 'Preescolar';
				break;
		}
		
		return $cual;
	}

	
	
	
	//funcion para generar la clave al usuario
    function gClave(){
        $mayu = Array("A","B","C","D","E","F","G","H","J","K","L","M","N","P","Q","R","S","T","U","V","X","Y","Z");
        $minu = Array("a","b","c","d","e","f","g","h","j","k","m","n","p","q","r","s","t","u","v","w","x","y","z");
        $cla = Array("Azul","Demo","Agua","Tierra","Rojo","Krismar","Verde","Naranja","Dorado","Amarillo","Negro","Tabla","cdROM","DVDrom","Hoja","Torre","Tablet","Android","Ventana","Alex","Mate","Monitor");   //Para las nuevas claves de la plataforma

        $cara = Array("*","+","/","#","=","$");      //Par los demos
        $clave = "";
        $claved = "";
        $p1 = 0;
        $p2 = 0;
        $p3 = 0;


        for ( $i = 1 ; $i <= 1000 ; $i ++) {
            $p1 = rand(0,(count($mayu)-1));
            $p2 = rand(0,(count($mayu)-1));
            $p3 = rand(0,(count($mayu)-1));
            $p4 = rand(0,(count($minu)-1));
            $p5 = rand(0,(count($cara)-1));
            $p6 = rand(0,(count($cla)-1));

            $clave = crc32($i.$p1.$p5);
            $clave = crc32($clave.$p4);
            $clave = trim($clave,"-");
            $clave = substr($clave,0,6);

            $clave = trim($clave,"-");

            $claved = $cla[$p6];
            $pt1 = $claved.$clave;

            $pt2 = substr($pt1,0,10);   //para obtener la clave
            
             return strtoupper($pt2);   //Regresamos la clave
        }
    }
?>
