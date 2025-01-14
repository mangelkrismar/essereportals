<?php
//Para que no envie el warning por el uso obsoleto del manejo de la base de datos
	error_reporting(0);
	
header('Content-Type: text/html; charset=ISO-8859-1');  

	if(isset($_POST['nombreCovid']) && isset($_POST['emailCovid'])){
		//Para las conexiones a las bases de datos
		include("conex_u.php");
		include("conexBases.php");
		
		$conn1 = Conecta();
		
		mysql_set_charset('utf8');
		
		//Obtenemos el correo para validar
		$email = $_POST["emailCovid"];
		
		$qry1 = "SELECT * FROM usercovidperu WHERE correocv = '".$email."'";
		$result = mysql_query($qry1,$conn1); 
		$row = mysql_num_rows($result);
		
		//Para restar las fechas		
		$fecha1= new DateTime(date("Y-n-j"));
		$fecha2= new DateTime("2020-06-01");
		$diff = $fecha1->diff($fecha2);

		//resultado de fechas
		$dd = $diff->days;
		
		//Usuario Nuevo
		if($row == 0){
			$dato = 0;
			//Base krismar.mx
			$name = $_POST["nombreCovid"];
			$uso = $_POST["qusoCovid"];
			$pais = $_POST["paisCovid"];
			$colegio = $_POST["colegioCovid"];
			$telefono = $_POST["telCovid"];
			$correo = $email;
			
			mysql_free_result($result);   //Se libera la memoria
			//Para los registros
			$qry1 = "SELECT * FROM usercovidperu ORDER BY idcv DESC LIMIT 1";
			
			$result = mysql_query($qry1,$conn1); 
			$row = mysql_num_rows($result);
			
			/****SE GENERA EL USUARIO***/
			//Es el primer registro
			if($row == 0){
				$qid = 1;
				
				$namecvd = 'democvd'.$qid;				
			}else{
				$rows = mysql_fetch_array($result);   //Para obtener los datos
				$qid = $rows['idcv'];     //Para la clave del producto
				
				$qid = $qid+1;
				$namecvd = 'democvd'.$qid;
			}
			
			/*****GENERA LA CLAVE****/
			$cve1 = gClave();
			
			mysql_free_result($result);   //Se libera la memoria
			//Para los registros
			mysql_set_charset('utf8');
			$qryI = "INSERT INTO usercovidperu (idcv,usercv,clavecv,nombre,correocv,usocv,paiscv,colegiocv,telefonocv)";
			$qryI = $qryI." VALUES ('".$qid."','".$namecvd."','".$cve1."','".$name."','".$correo."','".$uso."','".$pais."','".$colegio."','".$telefono."')";
			
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS DE DONDE SE ACOMULAN LOS USUARIOS
			mysql_query($qryI,$conn1);
			
			//Cerramos la conexion
			mysql_close($conn1);
			
			/*********PARA LOS DATOS DEL USUARIO*************/			
			$user = $namecvd;    //El usuario
			$userName = $name;
			$userApellido = $namecvd;					
			$ciudad = 'Metepec';
			$pais2 = 'MX';
			$lang = 'es_mx_utf8';
			$fIni = date("Y-n-j");
			$tDura = $dd;
			$clave = $cve1;
			/******TERMINAN LOS DATOS DEL USUARIO************/
			
			
			//Se inserta en las plataformas
			//query para dar de Alta en la plataforma preescolar (1)
			$conn = Conectarse(1);
			$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';
			$claveM = md5($clave.$cvModle);
			$qryA = "";
			$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
			$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
						
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS
			mysql_query($qryA,$conn);
			mysql_close($conn); 
			
			
			//query para dar de Alta en la plataforma secundaria (2)
			$conn = Conectarse(2);
			$cvModle = '~jd1N%9d]H?yABV57h8*yKlP6]O';  //Secundaria	
			$claveM = md5($clave.$cvModle);
			$qryA = "";
			$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
			$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
			
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS
			mysql_query($qryA,$conn);
			mysql_close($conn); 
			
			
			//query para dar de Alta en la plataforma ciencias (3)
			/*$conn = Conectarse(3);
			$claveM = md5($clave);
			$qryA = "";
			$qryA = "INSERT INTO usuarios (usuario,password,nombre,apellidos,correo,primerIngreso,tipoLicencia,fIni,tDura)";
			$qryA = $qryA." VALUES ('".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','si','infinita','".$fIni."','".$tDura."')";
			
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS
			mysql_query($qryA,$conn);
			mysql_close($conn); */
			//mdlbch_user			
			
			//query para dar de Alta en la plataforma primaria (4)
			$conn = Conectarse(4);
			$cvModle = '!b,T=6.g<q?s O=472UvWf/-=%';   //primaria
			$claveM = md5($clave.$cvModle);
			$qryA = "";
			$qryA = "INSERT INTO mdl_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
			$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
			
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS
			mysql_query($qryA,$conn);
			mysql_close($conn); 
			
			
			//query para dar de Alta en la plataforma bachillerato (5)
			$conn = Conectarse(5);
			//$cvModle = '';   //primaria
			$claveM = md5($clave);
			$qryA = "";
			$qryA = "INSERT INTO mdlbch_user (confirmed,mnethostid,username,password,firstname,lastname,email,city,country,lang,maildisplay,fIni,tDura)";
			$qryA = $qryA." VALUES (1,1,'".$user."','".$claveM."','".$userName."','".$userApellido."','".$correo."','".$ciudad."','".$pais2."','".$lang."',0,'".$fIni."','".$tDura."')";
			
			//SE INSERTA EL USUARIO EN LA BASE DE DATOS
			mysql_query($qryA,$conn);
			mysql_close($conn); 
			
			
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
								text-align: center !important;
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
					<h1>Bienvenido a los portales de <u>Parvularia, Primaria, Tercer Ciclo y Bachillerato</u> de Novaschool.</h1>
					<p>
					Tu licencia quedó activada a partir de hoy, vence el 31 de mayo del 2020. Tus datos de acceso a los 4 portales son:
					<br/>
					</p>
					<div>
					<b>Usuario: </b>'.$user.'<br/>
					<b>Contraseña: </b>'.$clave.'<br/>
					</div><br/>
					<b>Si tienes cualquier duda o comentario, escríbenos a cualquiera de estos correos:
					</b><br/><br/>
					<b><a href="mailto:ventas@novaschool.lat?Subject=Información de licencias" target="_top">ventas@novaschool.lat</a>, <a href="mailto:soporte@krismar.com.mx?Subject=Información de licencias" target="_top">soporte@krismar.com.mx</a><br/>
					<br/>
					Atentamente<br/>
					<a href="https://www.novaschool.lat" >Krismar Educación</a><br/>
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

			mail($destinatario,$asunto,$cuerpo,$headers);  //Aqui se envia el correo
			
			/*++++++++++++++++++++++++++++++++++++++++++*/			
		}else{
			$dato = 1;
		}				
		echo $dato;   //Se envía la respuesta ha ajax	
	}else{
		//print_r($_POST);
		echo "no puedes..**  **hi";
		//echo (var_dump($_POST));
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
