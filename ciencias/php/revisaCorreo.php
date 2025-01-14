<?php

function dias_transcurridos($fecha_i,$fecha_f)
{
	$dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
	$dias 	= abs($dias); $dias = floor($dias);		
	return $dias;
}

include("conexionPandilla.php");

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
	 
if ($conexion->connect_error) {
	die("La conexion falló: " . $conexion->connect_error);
}

$username = $_POST['correo1'];
	  
$sql = "SELECT * FROM $tbl_name WHERE usuario = '$username'";
	 
$result = $conexion->query($sql);

if(!$result) 
    die("Error: no se pudo realizar la consulta 0".$sql);

$row = $result->fetch_array(MYSQLI_ASSOC);

if ($result->num_rows > 0) {  
	if ($row['tipoLicencia']=="anual") {
		if ($row['primerIngreso']=="si") {
			echo "existe";
		}else{
			$fecha_actual=date("Y-m-d");
			$fecha_ingreso=$row['fechaIngreso'];
			$time = strtotime($fecha_ingreso);
			$newformat = date('Y-m-d',$time);

			$diasCumplidos = dias_transcurridos($fecha_ingreso,$fecha_actual);

			if($diasCumplidos>365){
				echo "no existe";
			}else{
				echo "existe";
			}

		}	
	}else{	
 		echo "existe";
	}
}else{
	echo "no existe";
}

?>