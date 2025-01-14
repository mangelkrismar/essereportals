<?php
	//PARA LA CONEXIÓN
	function conectaDB($qbase){
		//Datos de conexión a la base de datos
		switch($qbase){
			case 0:  //para los datos del producto a comprar
				$host = 'www.krismar.com.mx';
				$db = 'krismarc_krismarpage';
				$user = 'krismarc_page';
				$pass = '+Ic?RZkrW{Hv';
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