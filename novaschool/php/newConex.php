<?php
	
	//PARA LA CONEXIÓN
	function conectaDB($qbase){
		//Datos de conexión a la base de datos
		switch($qbase){
			//Para que llevar el control de los usuarios de los que se van registrando
			case 1: 
				$host = 'www.krismar.com.mx';
				$db = 'krismarc_regUserNav';
				$user = 'krismarc_userPla';
				$pass = '*_fw#MrFGD_6';
				break;
			//Para registrar los usuarios en la base de licencias
			case 2:
				$host = 'www.mdt.mx';
				$db = 'mdt_administracion_licencias';
				$user = 'mdt_krismarapps';
				$pass = 'krismarapps??123';
				break;
			case 3:
				$host = 'www.mdt.mx';
				$db = 'mdt_pandilla';
				$user = 'mdt_krismarapps';
				$pass = 'krismarapps??123';
				
				break;
		}
		
		//conexion de la base de datos
		$db = new mysqli($host, $user, $pass, $db);
		if ($db->connect_errno != null) {
		   echo "Error número $db->connect_errno conectando a la base de datos.<br>Mensaje: $db->connect_error.";
		   exit(); 
		}
		
		return $db;   //Se regresa la conexion activa		
	}
	
	//SE CIERRA LA CONEXION
	function cierraDB($cnx){
		$close = mysqli_close($cnx) or die("Ha sucedido un error inexperado en la desconexion de la base de datos");

		return $close;
	}
	
	
?>