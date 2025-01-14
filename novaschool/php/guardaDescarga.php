<?php
	//echo 'se consume desde otro archvio';
	//header("location: https://www.krismar.com.mx");
	//idSerie
	
	// Desactivar toda notificación de error
	//error_reporting(0);
	
	if (isset($_POST['dato'])) {
	
		date_default_timezone_set('America/Mexico_City');      
		$date = date("Y/m/d h:i:sa");
		
		include("conexBases.php");
		$conn = conectaDB(0);   //Para guardar los registros de descarga
		
		$qry = "INSERT INTO descargaAPK (fecha)";
		$qry = $qry." VALUES ('".$date."')";
		
		$conn->query($qry);
		
		$close = cierraDB($conn);
		
		echo '1';
	}else{
		echo '0';
	}
	
	
	
?>