<?php
	 // Se conecta al SGBD 
  	if(!($iden = mysql_connect("www.mdt.mx", "mdt_krismarapps", "krismarapps??123"))) 
    	die("Error: No se pudo conectar");
	
  	// Selecciona la base de datos 
  	if(!mysql_select_db("mdt_db_krismar_apps", $iden)) 
    	die("Error: No existe la base de datos");
    mysql_set_charset('utf8');
    
?>