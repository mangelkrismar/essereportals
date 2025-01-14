<?php
	
	include("conex_u.php");
	$conn=Conectarse();

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
		$qry = "SELECT * FROM users WHERE userT = '" . $name . "' AND claveT = '" . $clave . "'";
		$result = mysql_query($qry,$conn); 
		$row = mysql_num_rows($result);
		
		
		if($row == 0){
			$dato = 1;  //Existe el usuario, pero la clave no coincide
		}else{
			$dato = 2;   //El usuario y la clave son correctos 
		}
	}
	   
	echo $dato;    //Se envía la respuesta ha ajax	
?>

