<?php
	
	include("conex_u.php");
	$conn=Conecta();
	
	mysql_set_charset('utf8');

	//Para obtener las variables q vienen de flex o flash
	$name = $_POST["nameU"];
	$clave = $_POST["claveU"];
	
	$mensa = "";
	$dato = -1;  //0: Usuario incorrecto; 1: Clave incorrecta; 

	$qry = "SELECT * FROM users WHERE userT = '" . $name . "'";
	$result = mysql_query($qry,$conn); 
	$row = mysql_num_rows($result);
	
	if($row == 0){
		$dato = 0;  //El usuario no existe		
	}else{
		$row = mysql_fetch_array($result);   //Para obtener los datos
		$cveE = $row['claveE'];     //Para la clave del producto
		$cveT = $row['claveT'];     //Para la clave del producto
		
		if($cveE == NULL){
			$qry = "UPDATE users SET claveE='".md5($cveT)."' WHERE userT = '" . $name . "'";
			mysql_query($qry,$conn); 
		}
		
		$qry = "SELECT * FROM users WHERE userT = '" . $name . "' AND claveE = '" .md5($clave). "'";
		$result = mysql_query($qry,$conn); 
		$row = mysql_num_rows($result);
				
		if($row == 0){
			$dato = 1;  //Existe el usuario, pero la clave no coincide
		}else{			
			//Verificamos si aun no esta usado el usuario
			$row = mysql_fetch_array($result);   //Para obtener los datos
			$activa = $row['activa'];     //Para saber si esta activa la clave
			
			if($activa == 0){
				$dato = 2;   //El usuario y la clave son correctos, ademas no ha sido usado, Se procede la alta
			}else{
				$dato = 3;   //El usuario y la clave son correctos, pero ya esta en uso el usuario
			}			
		}		
	}
	   
	echo $dato;    //Se envía la respuesta ha ajax	
?>

